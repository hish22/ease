<?php

namespace Engine\Summon;

use Engine\Summon\Extracter;
use Eases\Ease;
use ValueError;
use Error_logic\Ease_errors;

class Fetcher {

    use Ease_errors;

    private function __construct(){}
    private static $file_parsed_version = [];
    public static function fetch($filename) {
        $lines = file("views/{$filename}.ease.php");
        $lines_number = 0;
        foreach($lines as $line) {
            $lines_number++;
            if(str_contains($line,'~')) {
                $extract_ease = explode('~',$line)[1];
                $extract_ease_with_space = explode(' ',$extract_ease);
                $extract_ease = Ease::tryFrom(explode("\r\n",$extract_ease_with_space[0])[0]);
                Extracter::extract(self::$file_parsed_version,
                $extract_ease,$extract_ease_with_space,$line,$lines_number,$filename);
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