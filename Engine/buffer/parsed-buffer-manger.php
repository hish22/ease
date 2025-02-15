<?php

namespace Engine\buffer;

trait ParsedContentBuffer {

    private static $buffer = [];

    protected static function addToBuffer($line) {
        self::$buffer[] = $line;
    } 

    protected static function retrieveBuffer() {
        return self::$buffer;
    }

    protected static function resetBuffer() {
        self::$buffer = [];
    }

}