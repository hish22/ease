<?php

namespace Error_logic\Line_err;

use Error_logic\Ease_errors;
use Exception;

trait Ease_line_err {

    public function null_parm_or_argum($eases_data_content) {
        if(is_null($eases_data_content) || empty($eases_data_content)) {
            $this->throwErr();
        }
    }

    public function null_parm_or_argum_inc_pran($ease_data_with_parnt) {
        $without_keyword = remove_keyword($ease_data_with_parnt);
        $args_data = trim(remove_pran($without_keyword));
        $clear = remove_tags($args_data);
        if(is_null($clear) || empty($clear)) {
            $this->throwErr();
        }
    }

    public function no_pran_found($ease_with_prant) {
        if(str_contains($ease_with_prant,"(") && str_contains($ease_with_prant,")")) {
            return;
        }
        $this->throwErr();
    }

    // These Are under test!!!!!! ->

    // public function provided_undefined_constant($ease_data_with_parnt) {
    //     $args_data = args_data($ease_data_with_parnt);
    // }

    // public function no_such_var($ease_data_with_parnt) {
        
    //     $args_data = args_data($ease_data_with_parnt);
    //         // Check vars
    //     $pattern = '/\$\w+\s*/';
    //     preg_match_all($pattern, $args_data, $matches);
    //     $b = "";
    //     foreach($matches[0] as $var) {
    //         $b .= $var;
    //     }
    //     $remove_dollar_sign = explode("$",$b);
    //     foreach($remove_dollar_sign as $var) {
    //         var_dump($var);
    //         if(!isset($GLOBALS[$var])) {
    //             $this->throwErr();
    //         }
    //     }
    // }

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