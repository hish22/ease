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

include_once 'Engine/buffer/parsed-buffer-manger.php';

include_once 'Engine/Summon/entry.php';

include_once 'Engine/Summon/fetcher.php';

include_once 'Engine/Summon/extracter.php';

include_once 'Engine/Construction/Construct_PHP.php';

include_once 'Engine/Optimize/save.php';

include_once 'Engine/Render/render.php';

include_once 'config/temp_config.php';

use Engine\Summon\Entry;

class EaseEngine extends Entry {

    /**
     * The Base instance of an ease engine.
     * @var EaseEngine
     */
    private static EaseEngine $engineOn;

    private function __construct(){}

    public function full() {
        # Tepmplate engine main logic
        if(!PRODUCTION && PARSETYPE == "full") {
            self::openView();
        }    
    }

    public function single($filepath) {
        if(!PRODUCTION && PARSETYPE == "single") {
            self::openFile("views/".$filepath.".ease.php");
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