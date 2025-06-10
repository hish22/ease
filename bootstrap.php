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

$list = [
    'users' => [
        'user1' => [
            'age' => 12
        ],
        'user2' => [
            'age' => 15
        ]
    ],
    'name' => 'dude'
];

render("home",$list);
