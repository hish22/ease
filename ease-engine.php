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

use Engine\Construction\Construct_PHP;
use Engine\Summon\Extracter;
use Engine\Summon\Fetcher;
use Error_logic\Ease_errors;

class EaseEngine extends Fetcher {

    private static EaseEngine $engineOn;

    private function ease_file($file) {
        if(str_contains($file,"ease.php")){

            $file_name = explode('.',$file)[0];

            Fetcher::fetch($file_name);

            Construct_PHP::construct($file_name,Fetcher::files_parsed_content(),'');
        }
        # RESET TAGS BUFFER
        Fetcher::set_parsed_content([]);
    }

    private function internal_dir($file) {
        if(is_dir("views/".$file) && $file != '.' && $file != '..') {

            $sub_view_dir = opendir("views/".$file);

            while($sub_file = readdir($sub_view_dir)) {

                if(str_contains($sub_file,"ease.php")){

                    $file_name = explode('.',$sub_file)[0];

                    Fetcher::fetch($file."/".$file_name);

                    Construct_PHP::construct($file_name,Fetcher::files_parsed_content(),$file);

                }
                # RESET TAGS BUFFER
                Fetcher::set_parsed_content([]);
            }
        }
    }

    private function read_eases() {
        $views_dir = opendir("views");
        while($file = readdir($views_dir)) {
            self::internal_dir($file);
            self::ease_file($file);
        }
    }

    private function __construct(){
        # Tepmplate engine main logic
        if(!$GLOBALS['Producation']) {
            self::read_eases();
        }    
    }

    public static function BuildEaseEngine(): EaseEngine {
        if(!isset(self::$engineOn)) {
            return new self;
        } else {
            return self::$engineOn;
        }
    }

}