<?php

namespace Error_logic;

use function Engine\Render\render;

trait Ease_errors {

    private function __construct(){}

    private static $error_msg;

    private static $line_of_error;

    private static $line_number;

    private static $filename;

    protected static function no_such_ease_error($error_msg,$line_of_error,$line_number,$filename) {
        self::$error_msg = $error_msg;
        self::$line_of_error = $line_of_error;
        self::$line_number = $line_number;
        self::$filename = $filename;
        render('error_view/_error');
        exit();
    }

    public static function print_noease_error() {
        echo "<h1 id='error_msg'>".self::$error_msg."</h1>";
        echo "<p id='line_of_error'> Occurred At: ".self::$filename.".ease.php</p>";
        echo "<p id='line_of_error'> Line ".self::$line_number.": ".self::$line_of_error."</p>";
    }

    protected static function null_parm_or_argum($eases_data_content,$error_msg,$line_of_error,$line_number,$filename) {
        if(is_null($eases_data_content) || empty($eases_data_content)) {
            self::no_such_ease_error($error_msg,$line_of_error,$line_number,$filename);
        }
    }

    protected static function no_same_file_included($filename,$eases_data_content,$error_msg,$line_of_error,$line_number) {
        if($filename == $eases_data_content) {
            self::no_such_ease_error($error_msg,$line_of_error,$line_number,$filename);
        }
    }

    protected static function no_args_for_reg_ease($eases_data_content,$error_msg,$line_of_error,$line_number,$filename) {
        if(!empty($eases_data_content)) {
            self::no_such_ease_error($error_msg,$line_of_error,$line_number,$filename);
        }
    }

}
