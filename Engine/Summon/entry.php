<?php

namespace Engine\Summon;

use Common\DS\Stack;
use Engine\Buffer\MainBuffer;
use Engine\Construction\Construct_PHP;

abstract class Entry extends MainBuffer {

    private function __construct(){}
    
    /**
     * Stack to track views directores
     * @var Stack
     */
    private static Stack $dir_stack;

    /**
     * Initialization of the directores Stack
     * @return void
     */
    private static function init_dir_stack() {
        self::$dir_stack = new Stack();
    }

    /**
     * Parses the content of an ease file and converts it into its equivalent PHP or HTML representation.
     * 
     * - Before parsing, check whether the file is an ease file.
     * - If it is, obtain the file name without the extension.
     * - Begin the fetch process, which includes:
     *   - Fetching each line in the ease file.
     *   - Parsing it into its specific enum type.
     *   - Converting the content into its corresponding PHP or HTML representation.
     * - At the end, construct the PHP file and clear the parsed content buffer to prepare for parsing the next file.
     * 
     * @param string $file The path to the ease file to be parsed.
     * 
     * @return void
     */
    private function parse_file(string $file) {

        if(str_contains($file,"ease.php")){

            if(!empty(self::retrieveBuffer())) {
                # RESET TAGS BUFFER
                self::resetBuffer();
            }

            $file_name = explode('.',$file)[0];

            Fetcher::fetch($file_name);

            Construct_PHP::construct($file_name,self::retrieveBuffer(),'');

            self::parse_partial_file();

        }
    }

    /**
     * Parses the included file through the ease parsed file into its equivalent PHP or HTML representation.
     * 
     * - First, checks if the stack is empty.
     * - The stack usually contains included files.
     * - Processes the files through the parsed file.
     * 
     * @return void
     */
    private function parse_partial_file() {
        if(PARSETYPE == "partial") {
            if(!is_null(self::partialQueue()) && !empty(self::partialQueue())) {

                self::parse_file(self::dequeueFromPartialQueue());
    
            }
        }
    }

    /**
     * Opens the "view" folder, iterates through its contents, and separates regular ease files from directory files.
     * 
     * - First, open a connection to the "view" folder.
     * - Iterate through the folder to identify and separate regular ease files from directory files.
     * - After separation, process and parse the ease files.
     * 
     * @return void
     */
    protected function openView(): void {
        self::init_dir_stack();

        $views = opendir(VIEWS_FILE);

        while($fobj = readdir($views)) {

            if($fobj != "." && $fobj != ".." && is_dir(VIEWS_FILE.DIRECTORY_SEPARATOR.$fobj)) {
                self::$dir_stack->push(VIEWS_FILE.DIRECTORY_SEPARATOR.$fobj);
            }

            self::parse_file(VIEWS_FILE.DIRECTORY_SEPARATOR.$fobj);

        }
        self::inner_views();
    }

    /**
     * Opens internal view folders, identifies and separates ease files from directory files, 
     * and processes the ease files.
     * 
     * - After handling the connection with the view file, open a connection to the internal view folders and files.
     * - Iterate through the folder to identify and separate regular ease files from directory files.
     * - After separation, process and parse the ease files.
     * 
     * @return void
     */
    private function inner_views(): void {
        while(self::$dir_stack->getTop() != 0) {

            $current_dir = self::$dir_stack->pop();

            $subView = opendir($current_dir);

            while($subFobj = readdir($subView)) {

                if($subFobj != "." && $subFobj != ".." && is_dir($current_dir.DIRECTORY_SEPARATOR.$subFobj)) {
                    self::$dir_stack->push($current_dir.DIRECTORY_SEPARATOR.$subFobj);
                }

                self::parse_file($current_dir.DIRECTORY_SEPARATOR.$subFobj);

            }

        }
    }
    /**
     * Parses the specified file.
     * 
     * This method parses only the specified file if the parsing type is set to single-file parsing.
     * 
     * @param mixed $filepath The path to the file to be parsed.
     * @return void
     */
    protected function openFile($filepath) {

        if(PARSETYPE == "partial") {
            self::init_partial_files_queue();
        }

        self::parse_file($filepath);
    }

}