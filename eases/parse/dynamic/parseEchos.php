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

    return "<?= $printable[1] ?>";
}

/**
 * Return a var_dump script to dump data
 * @param mixed $params
 * @return string
 */
function dump($params): string {
    $content = $params['line'];

    unsetParentheses($params);
    nullArguments($params);

    preg_match("/\((.*?)\)/",$content,$printable);

    return "<?php var_dump($printable[1]) ?>";
}
/**
 * Return a formated var_dump script
 * @param mixed $params
 * @return string
 */
function dumpf($params): string {
    return "<pre style='background:#f4f4f4; border:1px solid #ccc; padding:10px; margin:10px 0; font-family:monospace; font-size:18px;'>". dump($params) . "</pre>";
}