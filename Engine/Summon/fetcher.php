<?php

namespace Engine\Summon;

use Engine\Summon\Extracter;
use Eases\Ease;
use Error_logic\Block_err\Ease_block_err;
use Error_logic\Ease_err_enum;
use ValueError;
use Error_logic\Ease_errors;
use Error_logic\EaseErrorsHandler;

class Fetcher {

    private function __construct(){}
    private static $file_parsed_version = [];
    private static EaseErrorsHandler $errorHandler;

    public static function fetch($filename) {
        $lines = file("$filename.ease.php");

        $err = new EaseErrorsHandler(Ease_err_enum::ERR106->value,$filename,Ease_err_enum::ERR106->name);
        $err->no_ease_endif_or_if_included($lines);

        $lines_number = 0;
        // I may remove it.
        $controllable_line_nums = 0;
        foreach($lines as $line) {
            $lines_number++;
            $controllable_line_nums++;
            if(str_contains($line,'~')) {
                $extract_ease = explode('~',$line)[1];
                $extract_ease_with_space = explode(' ',$extract_ease);

                /* Check if the syntax of the ease provided as compresed line 
                /* -> ~IF(2 > 2) Rather than ~IF (2 > 2)
                */
                if(str_contains($extract_ease_with_space[0],"(")) {
                    $extract_ease_without_prant = explode("(",$extract_ease);
                    $extract_ease = Ease::tryFrom(explode("\r\n",$extract_ease_without_prant[0])[0]);
                } else {
                    $extract_ease = Ease::tryFrom(explode("\r\n",$extract_ease_with_space[0])[0]);
                }
                
                Extracter::extract(self::$file_parsed_version,
                $extract_ease,$extract_ease_with_space,$line,$lines_number,$controllable_line_nums,
                $filename);
            } else {
                self::$file_parsed_version[] = htmlspecialchars($line);
            }
        }
    }

    protected static function files_parsed_content() {
        return self::$file_parsed_version;
    }

    protected static function set_parsed_content($content) {
        self::$file_parsed_version = $content;
    }


}