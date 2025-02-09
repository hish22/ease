<?php

function args_data($arg) {
    // Remove leading and trailing spaces
    $rm_ws = trim($arg);

    // Find the first occurrence of the open parentheses
    $open_pos = strpos($rm_ws,"(") + 1;

    // The condition value without parentheses
    return substr($rm_ws,$open_pos,-1);
}