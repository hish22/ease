<?php

namespace Error_logic\Block_err;
use Error_logic\Ease_err_enum;
use Error_logic\Ease_errors;
use Common\DS\Stack;
use Eases\Ease;

trait Ease_block_err {

    private Stack $if_stack;

    // protected static final $Keywords = include_once 'config/eases/keywords.php';

    protected function init_stack() {
        if(!isset(self::$if_stack)) {
            $this->if_stack = new Stack();
        }
    }

    private function atomic_line($line): string {
        $line = trim(str_replace('~','',$line));
        $pos1 = strpos($line,'(');
        $pos2 = strpos($line,' ');
        if($pos1) {
            $line = substr($line,0,$pos1);
        } else if($pos2) {
            $line = substr($line,0,$pos2);
        }
        $line = trim($line);
        return $line;
    }

    public function iterative_conditional_examiner($lines,&$err) {

        // Count lines
        $lines_count = 0;

        // Initialize the Stack
        $this->init_stack();

        // If the file is empty just return the execution
        if(empty($lines)) {
            return;
        }

        // Loop through the file lines
        foreach ($lines as $line) {
            // Start check whither the line is IF or ELSEIF or ENDIF
            // -> and based on that, push to the stack or pop from it
            
            // Transform the line into specific control ease, example ("~IF (1 > 2)" to "IF")
            $line = $this->atomic_line($line);
            $lines_count+= 1;
            if(in_array($line,KEYWORDS['control']['start'])) { // str_contains($line,"~IF") || str_contains($line,"~LOOP")
                $this->if_stack->push($line);

            } else if (in_array($line,KEYWORDS['control']['mid'])) {

                if($this->if_stack->getTop() == 0) {
                    $err->setErrorCode(Ease_err_enum::ERR108->name);
                    $err->setErrorMsg(Ease_err_enum::ERR108->value);
                    $err->setLineNumber($lines_count);
                    $err->setLineOfError($line);
                    $this->throwErr();
                }

                $this->if_stack->pop();
                $this->if_stack->push($line);

            } else if(in_array($line,KEYWORDS['control']['end'])) { //trim($line) == "~ENDIF" || str_contains($line,"~ENDLOOP")
    
                if($this->if_stack->getTop() == 0) {
                    $err->setErrorCode(Ease_err_enum::ERR104->name);
                    $err->setErrorMsg(Ease_err_enum::ERR104->value);
                    $err->setLineNumber($lines_count); // Fix then or change it when needed.
                    $err->setLineOfError($line);
                    $this->throwErr();
                }

                $this->if_stack->pop();
            }

        }

        if($this->if_stack->getTop() != 0) {
            $err->setErrorCode(Ease_err_enum::ERR103->name);
            $err->setErrorMsg(Ease_err_enum::ERR103->value);
            $err->setLineNumber($lines_count);
            $err->setLineOfError("~".$this->if_stack->getValue());
            $this->throwErr();
        } else {
            return;
        }

    }

}