<?php

namespace Eases\dynamic;

use Exception;

function put(): String {
    return '<input type="hidden" value="PUT" name="_method">'."\n";
}

function delete(): String {
    return '<input type="hidden" value="DELETE" name="_method">'."\n";
}

function head(): String {
    return '<input type="hidden" value="HEAD" name="_method">'."\n";
}

function patch(): String {
    return '<input type="hidden" value="PATCH" name="_method">'."\n";
}

function inculde_content($content): string {
    $filtered = basename($content);
    return "<?php include 'storage/{$filtered}.php' ?>"."\n";
}

function _print($content): string {
    // Find parentheses pattern ($x, data)
    preg_match("/\((.*?)\)/",$content,$printable);

    return "<?= $printable[1] ?>"."\n";
}