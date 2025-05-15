<?php

namespace Engine\Summon;


use Eases\Ease;
use Eases\conditional;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;


class Extracter {

    use Ease_line_err;

    /**
     * There's no need to instantiate the extracter class.
     * 
     * The Extracter class is designed as a utility class that provides static 
     * methods for extracting and processing eases from a knowledge base.
     * 
     */
    private function __construct(){}

    /**
     * Extracts and processes a specified ease from the knowledge base and returns the corresponding PHP or HTML output.
     * 
     * This function handles various types of eases, such as PUT, DELETE, HEAD, INCLUDE, PATCH, IF, ENDIF, PRINT, and more. 
     * It also performs error handling by checking the ease syntax and validity before processing.
     * 
     * - The $ease parameter is passed and converted into the corresponding (Ease::Type) version.
     * - For each ease type, the function validates the parameters and generates the appropriate PHP/HTML code.
     * - Error handling is applied for missing arguments or invalid configurations.
     * 
     * @param Ease $ease The ease type used to extract the matched content.
     * @param array $ease_with_space The ease expression with spaces split.
     * @param string $line The current line being processed.
     * @param int $lines_count The total number of lines in the file.
     * @param string $filename The name of the file being processed.
     * 
     * @return string The generated PHP or HTML code corresponding to the specified ease.
     */
    public static function extract(Ease $ease,array &$ease_with_space,string $line,int $lines_count,string $filename): string {
        $removed_spaces_from_extract_ease = trim($ease_with_space[1] ?? '');

        $params = [
            'filename'=>$filename,
            'lines_count'=>$lines_count,
            'line'=>$line,
            'removed_spaces'=>$removed_spaces_from_extract_ease
        ];

        if(array_key_exists($ease->name,COMPILE['eases'])) {
            /** @return string */
            return COMPILE['eases'][$ease->name]($params);
        } else {
            $err = new EaseErrorsHandler($filename,
            Ease_err_enum::ERR101->value,
            Ease_err_enum::ERR101->name,
            $line,
            $lines_count);
            $err->throwErr();
            return '';
        }

    }


}