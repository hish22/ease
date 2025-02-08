<?php

namespace Eases\conditional;

/**
 * Summary of Eases\if_ease_cond
 * @return string
 * Check the syntax and logic of an IF ease statment
 */
function if_ease_cond($condition_state): String {

    // Remove leading and trailing spaces
    $rm_ws = trim($condition_state);

    // Find the first occurrence of the open parentheses
    $open_pos = strpos($rm_ws,"(") + 1;

    // The condition value without parentheses
    $condition = substr($rm_ws,$open_pos,-1); 

    // Return equivalent php statment
    return "<?php if($condition): ?>"."\n";
}

/**
 * Summary of Eases\end_ease_if
 * @return string
 * Close and end the ease if clause
 */
function end_ease_if(): String {
    return "<?php endif ?>"."\n";
}