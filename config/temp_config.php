<?php

# Check the type of producation
$config = file_get_contents("config.json");

/**
 * A Boolean value related to specify the development environment.
 */
define('PRODUCTION', json_decode($config)->Producation);

/**
 * A Boolean value related to specify the parsing type.
 */
define('PARSETYPE',json_decode($config)->ParseType);