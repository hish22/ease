<?php

namespace Engine\Render;

function render(String $file,Array $data=[]) {
    ob_start();
    extract($data);
    $filtered = basename($file);
    $content = ob_get_contents();
    include_once "storage/$filtered.php";
    abort_if_error();
    return $content;
}

function renderErr($err_data) {
    extract($err_data);
    include_once "storage/error_view/_error.php";
}

function renderSysErr($err_data) {
    extract($err_data);
    include_once "storage/error_view/_syserror.php";
}