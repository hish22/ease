<?php

namespace Error_logic;

use DS\Stack;

use function Engine\Render\render;

trait Ease_errors {

    private function __construct(){}

    private static String $error_code;

    private static String $error_msg;

    private static String $line_of_error;

    private static int $line_number;

    private static String $filename;

    protected static function ease_error($error_msg,$line_of_error,$line_number,$filename,$error_code) {
        self::$error_msg = $error_msg;
        self::$line_of_error = $line_of_error;
        self::$line_number = $line_number;
        self::$filename = $filename;
        self::$error_code = $error_code;
        return new self;
    }

    protected static function cond_ease_error($error_msg,$line_of_error,$filename,$error_code) {
        self::$error_msg = $error_msg;
        self::$line_of_error = $line_of_error;
        self::$filename = $filename;
        self::$error_code = $error_code;
        return new self;
    }

    protected function throwErr() {
        render('error_view/_error');
        exit();
    }

    public static function print_noease_error() {
        echo "<h1 id='error_msg'>".self::$error_msg."</h1>";
        echo "<p id='line_of_error'> Occurred At: ".self::$filename.".ease.php</p>";
        echo "<p id='line_of_error'> Line ".self::$line_number.": ".self::$line_of_error."</p>";
    }

    public static function getEaseErrMsg(): String {
        return self::$error_msg;
    }

    public static function getEaseErrFileName(): String {
        return self::$filename;
    }

    public static function getEaseErrLineNumber(): int {
        return self::$line_number;
    }

    public static function getEaseErrLine(): String {
        return self::$line_of_error;
    }

    public static function getEaseErrCode(): String {
        return self::$error_code;
    }

    protected function null_parm_or_argum($eases_data_content) {
        if(is_null($eases_data_content) || empty($eases_data_content)) {
            self::throwErr();
        }
    }

    protected function no_same_file_included($eases_data_content) {
        if(self::$filename == $eases_data_content) {
            self::throwErr();
        }
    }

    protected function no_args_for_reg_ease($eases_data_content) {
        if(!empty($eases_data_content)) {
            self::throwErr();
        }
    }

    protected function no_such_ease_file($ease_file_name) {
        if(!file_exists("storage/$ease_file_name.php")) {
            self::throwErr();
        }
    }

    protected function no_ease_endif_included(&$line_number) {
        $lines = file("views/".self::$filename.".ease.php");
        $lines = array_slice($lines,$line_number-1);

        if(empty($lines)) {
            return;
        }

        $if_stack = new Stack();
        foreach ($lines as $line) {
            if(str_contains($line,"~IF")) {
                $if_stack->push($line);
            } else if(trim($line) == "~ENDIF") {
                $if_stack->pop();
            }
            $line_number++;
        }
        $if_stack->getTop() == 0 ? "" : self::throwErr();
    }

}
