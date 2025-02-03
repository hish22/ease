<?php

namespace DS;

class Stack{

    private array $Stack;
    private int $top;

    public function __construct() {
        $this->Stack = [];
        $this->top = 0;
    }

    public function push($value) {
        $this->Stack[] = $value;
        $this->top++;
    }

    public function pop() {
        $poped = $this->Stack[$this->top-1];
        unset($this->Stack[$this->top-1]);
        $this->top--;
        return $poped;
    }

    public function getTop() {
        return $this->top;
    }


}