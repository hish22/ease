<?php

namespace Eases\Parse\Control;

use function Eases\Exceptions\invalidParams;
use function Eases\Exceptions\nullArguments;
use function Eases\Exceptions\unsetParentheses;

/**
 * Summary of Eases\conditional\loop_ease
 * @param mixed $statment
 * @return string
 * Check syntax and logic of LOOP ease.
 */
function loop_ease($params): string {

    $statment = $params[2];

    nullArguments($params);
    unsetParentheses($params);

    $extracted_statment = args_data_for_loop($statment);

    return "<?php foreach($extracted_statment): ?>"."\n";
}

/**
 * Summary of Eases\conditional\end_loop_ease
 * @return string
 * close and end the loop.
 */
function end_loop_ease($params): string {

    invalidParams($params);

    return "<?php endforeach ?>"."\n";
}

