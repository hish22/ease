<?php

namespace Engine\Construction;

use Engine\Optimize\Save;

class Construct_PHP {
    
    private function __construct(){}

    private static function createphp($filename,$content) {
        $file_path = "storage/{$filename}.php";
        $file_handle = fopen($file_path, 'w');
        fwrite($file_handle, html_entity_decode(implode($content)));
        fclose($file_handle);
    }

    private static function check_file($filename,$content,$dir) {
        if(file_exists("Template/storage/{$filename}.php")) {
            Save::fetch_cache($filename);
            $temp_cache = "{$filename}_hash";
            $_filename = $dir != '' ? $dir . "/" . $filename : $filename;
            if(Save::$hash[$temp_cache] != md5_file("views/{$_filename}.ease.php")) {
                Save::save_cache(array(
                    "{$filename}_hash" => md5_file("views/{$_filename}.ease.php")
                ),$filename);
                self::createphp($filename,$content);
            }
        } else {
            $_filename = $dir != '' ? $dir . "/" . $filename : $filename;
            Save::save_cache(array(
                "{$filename}_hash" => md5_file("views/{$_filename}.ease.php")
            ),$filename);
        }
    }

    public static function construct($filename,$content,$dir) {
        self::check_file($filename,$content,$dir);
        if(!file_exists("Template/storage/{$filename}.php")) {
            self::createphp($filename,$content);
        }
    }
}

