<?php

namespace Eases\Parse\Dynamic;

use function Eases\Exceptions\nullArguments;
use function Eases\Exceptions\nullParams;
use function Eases\Exceptions\unsetParentheses;

/**
 * Summary of _print
 * @param mixed $content
 * @return string
 * Print content from a file.
 * content is passed as an argument.
 */
function _print($params): string {

    $content = $params['line'];

    unsetParentheses($params);
    nullArguments($params);

    // Find parentheses pattern ($x, data)
    preg_match("/\((.*?)\)/",$content,$printable);

    return "<?= $printable[1] ?>"."\n";
}