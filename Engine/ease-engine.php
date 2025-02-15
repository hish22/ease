<?php

include_once 'loader/mainloader.php';

use Engine\Summon\Entry;
use Error_logic\SystemErr\Sys_err_enum;
use Error_logic\SystemErr\SysErrHandler;

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
        } else {
            $err = new SysErrHandler(
                Sys_err_enum::ERR501->name,
                Sys_err_enum::ERR501->value
            );
            $err->throwErr();
        }    
    }

    public function single($filepath) {
        if(!PRODUCTION && PARSETYPE == "single") {
            self::openFile("views/".$filepath.".ease.php");
        } else {
            $err = new SysErrHandler(
                Sys_err_enum::ERR502->name,
                Sys_err_enum::ERR502->value
            );
            $err->throwErr();
        }
    }

    public function partial($filepath) {
        if(!PRODUCTION && PARSETYPE == "partial") {
            self::openFile("views/".$filepath.".ease.php");
        } else {
            $err = new SysErrHandler(
                Sys_err_enum::ERR503->name,
                Sys_err_enum::ERR503->value
            );
            $err->throwErr();
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