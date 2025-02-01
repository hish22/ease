<?php

# Check the type of producation
$config = file_get_contents("config.json");

/**
 * @var bool A Boolean value related to specify the development environment
 */
$Producation = json_decode($config)->Producation;