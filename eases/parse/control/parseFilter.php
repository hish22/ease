<?php

namespace Eases\Parse\Control;

use function Eases\Exceptions\invalidParams;
use function Eases\Exceptions\nullArguments;
use function Eases\Exceptions\unsetParentheses;

function filter_logic($params) {

    nullArguments($params);
    unsetParentheses($params);

    $control_statment = remove_keyword($params['line']);

    $sep = arrow_sep($control_statment);

    $loop_sep = key_array_separation($sep[0]);

    $params['line'] = "($loop_sep)";

    $loop_start = loop_ease($params);

    $params['line'] = "($sep[1])";

    $if_start = if_ease_cond($params);

    return $loop_start . $if_start;
}

function end_filter_logic($params) {

    invalidParams($params);

    $if_end = end_ease_if($params);
    $loop_end = end_loop_ease($params);
    return $if_end . $loop_end;
}