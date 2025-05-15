<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function nullArguments($params){
    $err = new EaseErrorsHandler(
    $params['filename'],
        Ease_err_enum::ERR106->value,
        Ease_err_enum::ERR106->name,
        $params['line'],
        $params['lines_count']);
        $err->null_parm_or_argum_inc_pran($params['line']);
}