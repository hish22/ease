<?php

namespace Error_logic\Block_err;
use Error_logic\Ease_err_enum;
use Error_logic\Ease_errors;
use Common\DS\Stack;

trait Ease_block_err {

    private Stack $if_stack;

    protected function init_stack() {
        if(!isset(self::$if_stack)) {
            $this->if_stack = new Stack();
        }
    }

    // public function no_loop_or_endloop_included($line,&$err) {
    //     // Initialize the Stack
    //     $this->init_stack();

    //     // If the file is empty just return the execution
    //     if(empty($lines)) {
    //         return;
    //     }
 
    // }

    public function iterative_conditional_examiner($lines,&$err) {
        
        // THIS I WILL CHECK THEN
        // $StartKeywords = ['~IF','~LOOP'];
        // $endKeywords = ['~ENDIF','~ENDLOOP'];

        // Initialize the Stack
        $this->init_stack();

        // If the file is empty just return the execution
        if(empty($lines)) {
            return;
        }

        // THIS I WILL CHECK THEN
        // We need to check which keyword we are expecting
        // foreach($StartKeywords as $keyword) {
        //     if(str_contains($line,$keyword)) {

        //     }
        // }


        // if I have a cond or any type of control, I think I need to check the values inside it, or 
        // -> any control operation

        // if error is different where the check takes whole section of the code! 
        // -> so we need to track the lines it executed at

        // Loop through the file lines
        foreach ($lines as $line) {
            // Start check whither the line is IF or ELSEIF or ENDIF
            // -> and based on that, push to the stack or pop from it
            if(str_contains($line,"~IF") || str_contains($line,"~LOOP")) {

                $this->if_stack->push($line);

            } else if (str_contains($line,"~ELSEIF")) {

                if($this->if_stack->getTop() == 0) {
                    $err->setErrorCode(Ease_err_enum::ERR108->name);
                    $err->setErrorMsg(Ease_err_enum::ERR108->value);
                    $this->throwErr();
                }

                $this->if_stack->pop();
                $this->if_stack->push($line);

            } else if(trim($line) == "~ENDIF" || str_contains($line,"~ENDLOOP")) {

                if($this->if_stack->getTop() == 0) {
                    $err->setErrorCode(Ease_err_enum::ERR104->name);
                    $err->setErrorMsg(Ease_err_enum::ERR104->value);
                    $this->throwErr();
                }

                $this->if_stack->pop();
            }

        }

        if($this->if_stack->getTop() != 0) {
            $err->setErrorCode(Ease_err_enum::ERR103->name);
            $err->setErrorMsg(Ease_err_enum::ERR103->value);
            $this->throwErr();
        } else {
            return;
        }
    }

}