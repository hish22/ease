<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function invalidParams($params){
    $err = new EaseErrorsHandler(
    $params['filename'],
        Ease_err_enum::ERR102->value,
        Ease_err_enum::ERR102->name,
        $params['line'],
        $params['lines_count']);
        $err->no_args_for_reg_ease($params['removed_spaces']);
}