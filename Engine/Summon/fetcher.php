<?php

namespace Engine\Summon;

use Engine\Summon\Extracter;
use Eases\Ease;
use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Engine\buffer\MainBuffer;

class Fetcher extends MainBuffer {
    /**
     * There's no need to instantiate the fetcher class.
     */
    private function __construct(){}

    /**
     * Validate the entire block of an ease file.
     * @param mixed $filename
     * @param mixed $lines
     * @return void
     */
    private static function blockErrHandler($filename,$lines) {
        $err = new EaseErrorsHandler($filename);
        $err->iterative_conditional_examiner($lines,$err);
    }

    /**
     * Skips processing if the given line contains a single-line comment (//) 
     * before any '~' character. 
     * Useful for ignoring comment lines during parsing.
     *
     * @param mixed $line The line to analyze.
     * @return void
     */
    private static function commentPhase($line) {
        $observeCommentSlah = explode('~',$line)[0];
        if(str_contains(trim($observeCommentSlah),'//')) {
            return true;
        }
    }

    /**
     * Parses a line starting with `~{` and ending with `}` and converts it into raw PHP code.
     *
     * This method checks whether the given line is wrapped in the custom `~{}` syntax.
     * If it matches the pattern, the line is passed to the raw PHP parser and the 
     * resulting PHP code is stored in the internal buffer.
     *
     * @param mixed $line The input line to parse, typically a string.
     * @return bool Returns true if the line was successfully parsed and buffered; false otherwise.
     */
    private static function parseRaw($line): bool {
        $trimmed = trim($line);
        
        if (str_contains($trimmed, '~{') && str_contains($trimmed, '}')) {
            self::fillBuffer(self::injectTags(\Eases\Parse\Raw\rawPHP($trimmed),$line));
            return true;
        }

        return false;
    }

    /**
     * Injects HTML tags from the original line into a newly parsed ease string.
     *
     * This function takes a parsed ease string and the original line containing HTML tags,
     * extracts the tags by splitting the line at the '~' delimiter, and reconstructs a new
     * line by combining the left tags, the parsed ease string, and the right tags. The original
     * line is expected to be HTML-encoded to prevent XSS issues.
     *
     * @param string $new_parsed_ease The parsed ease string to be injected with tags.
     * @param string $line The original HTML-encoded line containing tags and the unparsed ease,
     *                     separated by a '~' delimiter.
     *
     * @return string The reconstructed line with the parsed ease string wrapped in the original
     *                HTML tags, trimmed of excess whitespace.
     */
    private static function injectTags($new_parsed_ease,$line) {
        // Now we need to fill the parsed line with the included tags
        // that was in the line before the parse operation
        // var_dump(str_contains(htmlspecialchars($line),'&lt;'));
        $tags = explode('~',htmlspecialchars($line));
        // var_dump($tags);

        // remove the unparsed ease
        $less_than_sign = strpos($tags[1],'&lt;');
        $right_tags = trim(substr($tags[1],$less_than_sign));
        $left_tags = trim($tags[0]);
        $new_line = trim($left_tags . $new_parsed_ease . $right_tags);
        return $new_line;
    }

    /**
     * Find the equivalent PHP or HTML line that corresponds to the specified ease.
     * 
     * This function determines which lines in the ease file are defined as eases and which are not.
     * It ensures that each line of the ease file is correctly converted to its corresponding ease type
     * without any errors or incorrect types.
     * 
     * - First, we check whether the line contains an ease symbol.
     * - Next, we examine the found ease to determine if it is a regular ease or a control ease.
     * - Once the type is determined, we extract the equivalent PHP or HTML line corresponding to the specified ease.
     * - Finally, we update the buffer with the new version of the file line to be embedded into the file.
     * 
     * @param string $filename The name of the file being processed.
     * @param string $line The current line being checked and processed.
     * @param int $lines_number The line number of the current line in the file.
     * @return void
     */
    private static function assembleEase(string $filename,string $line,int $lines_number): void {

        // At first we will check if we have
        // raw php conversion or not
        if(self::parseRaw($line)) { return; }

        if(str_contains($line,'~')) {

            // Before we assemble an ease
            // we need to check if this line is commented or not
            if(self::commentPhase($line)) {return;}

            // Now we extract the ease name from the line
            $extract_ease = explode('~',$line)[1];
            $extract_ease_with_space = explode(' ',$extract_ease);

            $easeEnum = self::ConstructEase($extract_ease_with_space);

            // Before we check if an ease has an argument or not, we need 
            // to make sure first that the value returned of constructEase
            // is not a NULL value
            if(is_null($easeEnum)) {
                $err = new EaseErrorsHandler($filename,
                Ease_err_enum::ERR101->value,
                Ease_err_enum::ERR101->name,
                $line,
                $lines_number);
                $err->throwErr();
            }

            // First we check if the ease has an argument, then after that
            // we check If the ease is INCLUDE and the parsing type is partial
            // to parse the INCLUDED content
            if(isset($extract_ease_with_space[1])) {
                self::ParsePartialFile($easeEnum,$extract_ease_with_space[1]);
            }
            
            // Now we begin the process of extracting the tags and logic of the
            // ease to its corresponding PHP script or HTML tag
            $new_parsed_ease = self::extractEase($easeEnum,
            $extract_ease_with_space,
            $line,
            $lines_number,
            $filename);

            // Based on the pattern of an HTML tag, we check if an ease containes HTML tags within its line 
            $pattern = '/^<\/?[a-zA-Z][a-zA-Z0-9]*(?:\s+[a-zA-Z-]+(?:=(?:"[^"]*"|\'[^\']*\'|[^\s>]*))?)*\s*\/?>/';
            if(preg_match($pattern, trim($line))) {
                $new_parsed_ease = self::injectTags($new_parsed_ease,$line);
            }

            // Fill the buffer with resulted tags and eases
            self::fillBuffer($new_parsed_ease);


        } else {
            self::addToBuffer(trim(htmlspecialchars($line)));
        }
    }

    /**
     * Finds and processes the control ease from the given input.
     * 
     * This function checks if the syntax of the provided ease is in the correct format. Specifically,
     * it ensures that any ease symbol (like `~IF`) is properly separated from its parameters and 
     * extracts the corresponding ease.
     * 
     * - It checks if the ease contains parentheses, indicating a control ease (e.g., `~IF(2 > 2)`).
     * - If parentheses are present, the function splits the string at the parentheses and processes 
     *   the ease accordingly.
     * - If no parentheses are found, the function simply processes the ease using the first part of 
     *   the extracted string.
     * 
     * After processing, the corresponding ease is assigned returned back to the findEase function.
     * 
     * Additional Notes:
     * - The function handles cases where the ease symbol and its arguments are tightly packed (e.g., `~IF(2 > 2)`), 
     *   ensuring the syntax is correctly parsed.
     * - The extracted ease is always transformed into an `Ease::Type` enum using `Ease::tryFrom`.
     * 
     * @param string $extract_ease The input ease string that will be processed and modified. 
     *                             This should be the raw ease input, which may or may not contain parentheses.
     * @param array  $extract_ease_with_space The array containing the split ease parts with space separation.
     *                                       This is used to assist in parsing the ease symbol and its parameters.
     * @return Ease|null
     */
    private static function ConstructEase(&$extract_ease_with_space): Ease|null {
        $ease = strtoupper(trim(explode("(",$extract_ease_with_space[0])[0]));
        $ease = explode('<',$ease)[0];
        return Ease::tryFrom($ease);
    }
    /**
     * Extract the specified ease from the ease knowledge base (Ease enum).
     * 
     * This function attempts to retrieve the provided ease from the ease knowledge base by
     * calling the extract function.
     * 
     * @param Ease $extract_ease The ease used to extract the matched content.
     * @param array $extract_ease_with_space The components of the ease, split by spaces.
     * @param string $line The current line being processed.
     * @param int $lines_number The line number of the current line in the file.
     * @param string $filename The name of the file being processed.
     * @return string The extracted ease.
     */
    private static function extractEase(Ease &$extract_ease,
    array &$extract_ease_with_space,
    string $line,
    int $lines_number,
    string $filename): string {
       return Extracter::extract($extract_ease,$extract_ease_with_space,$line,$lines_number,$filename);
    }

    private static function fillBuffer($new_parsed_ease) {
        if(!empty($new_parsed_ease)) {
            self::addToBuffer($new_parsed_ease);  
        }
    }
    /**
     * Start the process of parsing an ease file.
     * 
     * This function is considered the entry point to the engine. It operates on each ease.php file, performing
     * conversion operations while ensuring the file's validity by performing a block error check.
     * 
     * - First, we fetch the content of the file obtained from the entry class.
     * - Next, we validate the syntactical representation of the file.
     * - Then, we declare the file line counter.
     * - Finally, we iterate through each line of the file and find the corresponding ease for it.
     * 
     * @param string $filename The name of the ease file to be parsed.
     * @return void
     */
    public static function fetch(string $filename): void {
        $lines = file("$filename.ease.php");

        self::blockErrHandler($filename,$lines);

        $lines_number = 0;
        // I may remove it.
        $controllable_line_nums = 0;
        foreach($lines as $line) {

            self::assembleEase($filename,$line,$lines_number);

            $lines_number++;
            $controllable_line_nums++;

        }
    }

    /**
     * Parses any Ease file that is included within the parsed file.
     * 
     * When the parsing system is configured as partial, 
     * any included Ease file within each Ease file
     * will be parsed into its equivalent PHP file.
     * 
     * @param \Eases\Ease $ease The Ease instance to be processed.
     * @param string $filePath The path of the Ease file to parse.
     * @return void
     */
    private static function ParsePartialFile(Ease $ease,string $filePath) {
        if(PARSETYPE == "partial" && $ease == Ease::INCLUDE) {
            self::enqueueToPratialQueue("views/".trim($filePath).".ease.php");
        }
    }

}