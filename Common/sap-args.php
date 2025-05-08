<?php

function args_data($arg) {
    // Remove leading and trailing spaces
    $rm_ws = trim($arg);

    // Find the first occurrence of the open parentheses
    $open_pos = strpos($rm_ws,"(") + 1;

    // The condition value without parentheses
    return substr($rm_ws,$open_pos,-1);
}

function args_data_for_loop($arg) {
    // Remove leading and trailing spaces
    $rm_ws = trim($arg);

    // Find the first occurrence of the open parentheses
    $open_pos = strpos($rm_ws,"(") + 1;
    
    // The statment value without parentheses
    $statment = substr($rm_ws,$open_pos,-1);

    // check whether the statement has 'as' or not and handle the return based on it
    if(!str_contains($statment,'as')) {
        $sub_statment = substr($statment,0,-1);
        return "$statment as $sub_statment";
    } else {
        return $statment;
    }

    // foreach ($variable as $key => $value) {
    //     # code...
    // }

     
}