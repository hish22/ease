<?php

namespace Error_logic\Line_err;

use Error_logic\Ease_errors;

trait Ease_line_err {

    public function null_parm_or_argum($eases_data_content) {
        if(is_null($eases_data_content) || empty($eases_data_content)) {
            $this->throwErr();
        }
    }

    public function null_parm_or_argum_inc_pran($ease_data_with_parnt) {
        $args_data = args_data($ease_data_with_parnt);
        if(is_null($args_data) || empty($args_data)) {
            $this->throwErr();
        }
    }

    public function no_same_file_included($eases_data_content) {
        if($this->filename == $eases_data_content) {
            $this->throwErr();
        }
    }

    public function no_args_for_reg_ease($eases_data_content) {
        if(!empty($eases_data_content)) {
            $this->throwErr();
        }
    }

    public function no_such_ease_file($ease_file_name) {
        if(!file_exists("storage/$ease_file_name.php")) {
            if(file_exists("views/$ease_file_name.ease.php")) {
                return;
            }
            $this->throwErr();
        }
    }

}