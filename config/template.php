<?php

# Check the type of producation
$config = file_get_contents("config.json");

/**
 * A Boolean value related to specify the development environment.
 */
define('PRODUCTION', json_decode($config)->main->Producation);

/**
 * A Boolean value related to specify the parsing type.
 */
define('PARSETYPE',json_decode($config)->main->ParseType);

/**
 * A Boolean value related to enable formatted PHP errors.
 */
define("FORMAT_PHP_ERROR",json_decode($config)->error->formatPHP);

/**
 * A String value related to the location of the views file.
 */
define("VIEWS_FILE",json_decode($config)->location->views);