<?php

namespace Error_logic\Block_err;
use Error_logic\Ease_errors;
use DS\Stack;

trait Ease_block_err {

    private Stack $if_stack;

    protected function init_stack() {
        if(!isset(self::$if_stack)) {
            $this->if_stack = new Stack();
        }
    }

    public function no_ease_endif_or_if_included($lines) {

        // Initialize the Stack
        $this->init_stack();

        // If the file is empty just return the execution
        if(empty($lines)) {
            return;
        }

        // if I have a cond or any type of control, I think I need to check the values inside it, or 
        // -> any control operation

        // if error is different where the check takes whole section of the code! 
        // -> so we need to track the lines it executed at

        // Loop through the file lines
        foreach ($lines as $line) {
            // Start check whither the line is IF or ENDIF
            // -> and based on that, push to the stack or pop from it
            if(str_contains($line,"~IF")) {

                $this->if_stack->push($line);

            } else if(trim($line) == "~ENDIF") {

                if($this->if_stack->getTop() == 0) {
                    $this->throwErr();
                }

                $this->if_stack->pop();
            }

        }

        if($this->if_stack->getTop() != 0) {
            $this->throwErr();
        } else {
            return;
        }
    }

}