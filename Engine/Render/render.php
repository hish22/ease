<?php

namespace Engine\Render;

function render($content) {
    include_once "storage/$content.php";
}