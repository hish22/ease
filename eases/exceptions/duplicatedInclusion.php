<?php

namespace Eases\Exceptions;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;
function duplicatedInclusion($params){
    $err = new EaseErrorsHandler(
    $params[0],
        Ease_err_enum::ERR203->value,
        Ease_err_enum::ERR203->name,
        $params[2],
        $params[1]);
        $err->no_same_file_included($params[3]);
}