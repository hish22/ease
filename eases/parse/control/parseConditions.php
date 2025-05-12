<?php

namespace Eases\Parse\Control;

use function Eases\Exceptions\invalidParams;
use function Eases\Exceptions\nullArguments;
use function Eases\Exceptions\unsetParentheses;

/**
 * Summary of Eases\if_ease_cond
 * @return string
 * Check the syntax and logic of an IF ease statment.
 */
function if_ease_cond($params): String {

    $condition_state = $params[2];

    nullArguments($params);
    unsetParentheses($params);
    
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
function else_if_ease_cond($params): string {

    $condition_state = $params[2];

    $condition = args_data($condition_state);

    nullArguments($params);
    unsetParentheses($params);

    // Return equivalent php statment
    return "<?php elseif($condition): ?>"."\n";
}

/**
 * Summary of Eases\end_ease_if
 * @return string
 * Close and end the ease if clause.
 */
function end_ease_if($params): String {

    invalidParams($params);

    return "<?php endif ?>"."\n";
}