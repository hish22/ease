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
        array_push($this->Stack,$value);
        $this->top++;
    }

    public function pop() {
        if(empty($this->Stack)) {
            throw new \UnderflowException("Stack is empty, cannot pop");
        }
        // $poped = $this->Stack[$this->top-1];
        // unset($this->Stack[$this->top-1]);
        // $this->Stack = array_values($this->Stack);
        $this->top--;
        return array_pop($this->Stack);
    }

    public function getTop() {
        return $this->top;
    }


}