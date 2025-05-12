<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function nullArguments($params){
    $err = new EaseErrorsHandler(
    $params[0],
        Ease_err_enum::ERR106->value,
        Ease_err_enum::ERR106->name,
        $params[2],
        $params[1]);
        $err->null_parm_or_argum_inc_pran($params[2]);
}