<?php

include_once 'Common/sap-args.php';

include_once 'eases/ease.php';

include_once 'eases/dynamic_ease.php';

include_once "eases/conditional_ease.php";

include_once 'error_logic/line-err/ease-line-err.php';

include_once 'error_logic/block-err/ease-block-err.php';

include_once 'error_logic/ease-errors-handler.php';

include_once 'error_logic/ease-err-enum.php';

include_once "DS/Stack.php";

include_once 'Engine/Summon/fetcher.php';

include_once 'Engine/Summon/extracter.php';

include_once 'Engine/Construction/Construct_PHP.php';

include_once 'Engine/Optimize/save.php';

include_once 'Engine/Render/render.php';

include_once 'config/temp_config.php';

use DS\Stack;
use Engine\Construction\Construct_PHP;
use Engine\Summon\Extracter;
use Engine\Summon\Fetcher;
use Error_logic\Ease_errors;

class EaseEngine extends Fetcher {

    /**
     * The Base instance of an ease engine.
     * @var EaseEngine
     */
    private static EaseEngine $engineOn;
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

    // * - Before parsing an ease file,  
    // *   check whether the file is an ease file or not.  
    // * - If it is, obtain the file name without the extension.  
    // * - Begin the fetch process, which includes:  
    // *   - Fetching each line in the ease file  
    // *   - Parsing it into its specific enum type  
    // *   - Converting the content into its equivalent PHP or HTML representation  
    // * - At the end, construct the PHP file and clear the parsed content buffer  
    // *   to prepare for parsing the next file.  
    /**
     * Summary of parse_file
     * @param string $file
     * @return void
     * Parse the content of ease file into its equivalent in php or html
     */
    private function parse_file(string $file) {
        if(str_contains($file,"ease.php")){

            # RESET TAGS BUFFER
            Fetcher::set_parsed_content([]);

            $file_name = explode('.',$file)[0];

            Fetcher::fetch($file_name);

            Construct_PHP::construct($file_name,Fetcher::files_parsed_content(),'');
        }
    }

    // * - First, open a connection to the "view" folder.
    // * - Iterate through the folder to identify and separate 
    // *   regular ease files from director files.
    // * - After separation, process the ease files and parse them.
    /**
     * Opens the view folder.
     * @return void
     */
    private function openView(): void {
        self::init_dir_stack();

        $views = opendir("views");

        while($fobj = readdir($views)) {

            if($fobj != "." && $fobj != ".." && is_dir("views".DIRECTORY_SEPARATOR.$fobj)) {
                self::$dir_stack->push("views".DIRECTORY_SEPARATOR.$fobj);
            }

            self::parse_file("views".DIRECTORY_SEPARATOR.$fobj);

        }
        self::inner_views();
    }

    // * - After handling the connection with the view file,  
    // * - open a connection to the "internal view folders and files."  
    // * - Iterate through the folder to identify and separate  
    // *   regular ease files from director files.  
    // * - After separation, process the ease files and parse them.  
    /**
     * Opens internal view folders.
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

    private function __construct(){
        # Tepmplate engine main logic
        if(!$GLOBALS['Producation']) {
            self::openView();
            //self::read_eases();
        }    
    }
    /**
     * Building the ease engine
     * @return EaseEngine
     */
    public static function BuildEaseEngine() {        
        if(!isset(self::$engineOn)) {
            return new self;
        } else {
            return self::$engineOn;
        }
    }

}