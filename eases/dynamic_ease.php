<?php

namespace Eases\dynamic;

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
    return "<?php include 'storage/{$content}.php' ?>"."\n";
}