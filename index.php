<?php

use function Engine\Render\Render;

include_once 'Engine/ease-engine.php';

$eng = EaseEngine::BuildEaseEngine();

$eng->single("home");

$eng->single("test/about");

render("home",["name"=>"hisham"]);