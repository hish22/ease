<?php

namespace Eases\Parse\Dynamic;

use function Eases\Exceptions\invalidParams;

function get($params): string {
    invalidParams($params);
    return '<input type="hidden" value="GET" name="_method">'."\n";
}

function post($params): string {
    invalidParams($params);
    return '<input type="hidden" value="POST" name="_method">'."\n";
}

function put($params): String {
    invalidParams($params);
    return '<input type="hidden" value="PUT" name="_method">'."\n";
}

function delete($params): String {
    invalidParams($params);
    return '<input type="hidden" value="DELETE" name="_method">'."\n";
}

function head($params): String {
    invalidParams($params);
    return '<input type="hidden" value="HEAD" name="_method">'."\n";
}

function patch($params): String {
    invalidParams($params);
    return '<input type="hidden" value="PATCH" name="_method">'."\n";
}