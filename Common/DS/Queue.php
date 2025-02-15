<?php

namespace Common\DS;

class Queue {

    private $Queue = [];

    public function enqueue($value) {
        array_push(self::$Queue,$value);
    }

    public function dequeue() {
        return array_shift(self::$Queue);
    }

    public function queue() {
        return self::$Queue;
    }

}