<?php

namespace Error_logic;

use DS\Stack;
use Error_buffer;
use Error_logic\Block_err\Ease_block_err;

use Error_logic\Line_err\Ease_line_err;
use function Engine\Render\render;
use function Engine\Render\renderErr;

class EaseErrorsHandler {

    use Ease_block_err;
    use Ease_line_err;

    private String $error_code;

    private String $error_msg;

    private String $line_of_error;

    private int $line_number;
    
    private String $filename;

    public function __construct($error_msg, $filename, $error_code, $line_of_error='', $line_number=0,) {
        $this->error_msg = $error_msg;
        $this->line_of_error = $line_of_error;
        $this->line_number = $line_number;
        $this->filename = $filename;
        $this->error_code = $error_code;
    }

    public function printErr() {
        echo "<h1>Error: {$this->error_msg}</h1>";
        echo "<p>File: {$this->filename}.ease.php</p>";
        echo "<p>Line {$this->line_number}: {$this->line_of_error}</p>";
    }

    public function throwErr() {
        renderErr([
            "error_msg" => $this->error_msg,
            "line_of_error" => $this->line_of_error,
            "line_number" => $this->line_number,
            "filename" => $this->filename,
            "error_code" => $this->error_code
        ]);
        exit();
    }

    public function getEaseErrMsg(): String {
        return self::$error_msg;
    }

    public function getEaseErrFileName(): String {
        return self::$filename;
    }

    public function getEaseErrLineNumber(): int {
        return self::$line_number;
    }

    public function getEaseErrLine(): String {
        return self::$line_of_error;
    }

    public function getEaseErrCode(): String {
        return self::$error_code;
    }

}
