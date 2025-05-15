<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function nullParams($params){
    $err = new EaseErrorsHandler(
    $params['filename'],
        Ease_err_enum::ERR201->value,
        Ease_err_enum::ERR201->name,
        $params['line'],
        $params['lines_count']);
        $err->null_parm_or_argum($params['removed_spaces']);
}