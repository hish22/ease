<?php

use function Engine\Render\Render;

include_once 'Engine/ease-engine.php';

$eng = EaseEngine::BuildEaseEngine();

$eng->full();

// $eng->partial("home");

render("home",["name"=>"hisham"]);


