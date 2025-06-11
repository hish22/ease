<?php

/**
 * USE THE MAIN RENDER FUNCTION
 */
use function Engine\Render\Render;

/**
 * INCLUDE THE ENGINE UTILITIES
 */
include_once 'Engine/ease-engine.php';


$eng = EaseEngine::BuildEaseEngine();

$eng->full();

$info = [
    'message' => 'Welcome To The Ease Template engine'
];

render('doc',$info);