<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function invalidParams($params){
    $err = new EaseErrorsHandler(
    $params[0],
        Ease_err_enum::ERR102->value,
        Ease_err_enum::ERR102->name,
        $params[2],
        $params[1]);
        $err->no_args_for_reg_ease($params[3]);
}