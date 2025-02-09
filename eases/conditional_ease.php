<?php

namespace Eases\conditional;

/**
 * Summary of Eases\if_ease_cond
 * @return string
 * Check the syntax and logic of an IF ease statment
 */
function if_ease_cond($condition_state): String {
    
    $condition = args_data($condition_state);

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