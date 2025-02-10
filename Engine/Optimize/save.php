<?php

namespace Engine\Optimize;

class Save {

    private function __construct(){}

    public static $hash = [];

    public static function save_cache($hash_data,$filename): void {
        $parsed_json = json_encode($hash_data);
        $base_version = basename($filename);
        $cache_file = "data/cache/{$base_version}_cache.json";
        file_put_contents($cache_file,$parsed_json);
    }

    public static function fetch_cache($hash_data_file_content): void {
        self::$hash = json_decode(file_get_contents("data/cache/{$hash_data_file_content}_cache.json"),true);
    }

}
