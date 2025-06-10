<?php

namespace Eases\Parse\Dynamic;

use function Eases\Exceptions\invalidParams;

/**
 * Generates a hidden input indicating the HTTP GET method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function get($params): string {
    invalidParams($params);
    return '<input type="hidden" value="GET" name="_method">';
}

/**
 * Generates a hidden input indicating the HTTP POST method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function post($params): string {
    invalidParams($params);
    return '<input type="hidden" value="POST" name="_method">';
}

/**
 * Generates a hidden input indicating the HTTP PUT method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function put($params): string {
    invalidParams($params);
    return '<input type="hidden" value="PUT" name="_method">';
}

/**
 * Generates a hidden input indicating the HTTP DELETE method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function delete($params): string {
    invalidParams($params);
    return '<input type="hidden" value="DELETE" name="_method">';
}

/**
 * Generates a hidden input indicating the HTTP HEAD method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function head($params): string {
    invalidParams($params);
    return '<input type="hidden" value="HEAD" name="_method">';
}

/**
 * Generates a hidden input indicating the HTTP PATCH method.
 *
 * @param mixed $params Parameters passed to the ease directive.
 * @return string
 */
function patch($params): string {
    invalidParams($params);
    return '<input type="hidden" value="PATCH" name="_method">';
}
