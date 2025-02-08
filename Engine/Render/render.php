<?php

namespace Engine\Render;

function render(String $file,Array $data=[]) {
    ob_start();
    extract($data);
    $filtered = basename($file);
    $content = ob_get_contents();
    include_once "storage/$filtered.php";
    return $content;
}

function renderErr() {
    include_once "storage/error_view/_error.php";
}