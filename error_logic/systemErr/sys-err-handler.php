<?php

namespace Error_logic\SystemErr;

use function Engine\Render\renderSysErr;

class SysErrHandler {
    private String $error_code;

    private String $error_msg;

    public function __construct($error_code,$error_msg) {
        $this->error_msg = $error_msg;
        $this->error_code = $error_code;
    }

    public function throwErr() {
        renderSysErr([
            "error_msg" => $this->error_msg,
            "error_code" => $this->error_code
        ]);
        exit();
    }

    public function getEaseErrCode(): String {
        return self::$error_code;
    }

    public function getEaseErrMsg(): String {
        return self::$error_msg;
    }


}