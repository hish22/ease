<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function wrongInclusion($params){
    $err = new EaseErrorsHandler(
    $params['filename'],
        Ease_err_enum::ERR202->value,
        Ease_err_enum::ERR202->name,
        $params['line'],
        $params['lines_count']);
        $err->no_such_ease_file($params['removed_spaces']);
}