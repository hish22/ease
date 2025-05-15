<?php

/**
 * Summary of args_data
 * @param mixed $arg
 * @return string
 * remove the parentheses for conditions.
 */
function args_data($arg) {
    // Remove leading and trailing spaces
    $rm_ws = trim($arg);

    // Find the first occurrence of the open parentheses
    $open_pos = strpos($rm_ws,"(") + 1;

    // The condition value without parentheses
    return substr($rm_ws,$open_pos,-1);
}
/**
 * Summary of args_data_for_loop
 * @param mixed $arg
 * @return string
 * handle arguments for loop ease
 */
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
     
}
/**
 * Summary of remove_pran
 * @param mixed $arg
 * @return array|string
 * remove parentheses
 */
function remove_pran($arg) {
    // replace ( with ""
    $rm_open_pran =  str_replace('(','',$arg);
    
    // replace ) with ""
    $rm_close_parn = str_replace(')','',$rm_open_pran);

    return $rm_close_parn;
}

/**
 * Summary of key_array_separation
 * @param mixed $arg
 * @return string
 * separate key , array compound (array,key).
 */
function key_array_separation($arg) {
    
    // Separate by , between (array,key)
    $separated = explode(',',$arg);
    
    if (str_contains($arg,',')) { 
        // trim both sides
        $separated[0] = trim($separated[0]);
        $separated[1] = trim($separated[1]);
        return "$separated[0] as $separated[1]";
    } else {
        // just return the $array
        $separated[0] = trim($separated[0]);
        return $separated[0];
    }
}

/**
 * Summary of arrow_sep
 * @param mixed $arg
 * @return string[]
 * separate by arrow sign , example ((array,key) => cond).
 */
function arrow_sep($arg) {

    $removed_pran = remove_pran($arg);

    // explode by =>
    $sep = explode('=>',$removed_pran);
    // trim both sides
    $sep[0] = trim($sep[0]);
    $sep[1] = trim($sep[1]);
    return $sep;
}

/**
 * Summary of remove_keyword
 * @param mixed $arg
 * @return string
 * remove keyword by first open parentheses appearance.
 */
function remove_keyword($arg) {
    $pos = strpos($arg,'(');
    return substr($arg,$pos);
}