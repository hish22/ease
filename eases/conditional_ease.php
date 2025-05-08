<?php

namespace Eases\conditional;

/**
 * Summary of Eases\if_ease_cond
 * @return string
 * Check the syntax and logic of an IF ease statment.
 */
function if_ease_cond($condition_state): String {
    
    $condition = args_data($condition_state);

    // Return equivalent php statment
    return "<?php if($condition): ?>"."\n";
}
/**
 * Summary of Eases\conditional\else_if_ease_cond
 * @param mixed $condition_state
 * @return string
 * Check the syntax and logic of an ELSEIF ease statment.
 */
function else_if_ease_cond($condition_state): string {
    $condition = args_data($condition_state);

    // Return equivalent php statment
    return "<?php elseif($condition): ?>"."\n";
}

/**
 * Summary of Eases\end_ease_if
 * @return string
 * Close and end the ease if clause.
 */
function end_ease_if(): String {
    return "<?php endif ?>"."\n";
}

/**
 * Summary of Eases\conditional\loop_ease
 * @param mixed $statment
 * @return string
 * Check syntax and logic of LOOP ease.
 */
function loop_ease($statment): string {

    $extracted_statment = args_data_for_loop($statment);

    return "<?php foreach($extracted_statment): ?>"."\n";
}
/**
 * Summary of Eases\conditional\end_loop_ease
 * @return string
 * close and end the loop.
 */
function end_loop_ease(): string {
    return "<?php endforeach ?>"."\n";
}