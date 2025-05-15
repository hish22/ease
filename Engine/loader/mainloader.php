<?php

/**
 * Retrieve the main configuration file for the system.
 */

// Template system configuration file.
include_once 'config/template.php';

/**
 * Retrieve commonly used functions shared across different classes.
 */

// Extract content inside parentheses.
include_once 'Common/dismantling.php';

// Stack implementation.
include_once 'Common/DS/Stack.php';

// Queue implementation.
include_once 'Common/DS/Queue.php';

/**
 * Retrieve the core logic related to ease code.
 */

// Main ease enum.
include_once 'eases/ease.php';

// Core logic for dynamic easing.
include_once 'eases/parse/dynamic/parseEchos.php';
include_once 'eases/parse/dynamic/parseHttpMethods.php';
include_once 'eases/parse/dynamic/parseIncludes.php';
// Core logic for control easing.
include_once 'eases/parse/control/parseConditions.php';
include_once 'eases/parse/control/parseLoops.php';
include_once 'eases/parse/control/parseFilter.php';
// Core eases exceptions
include_once 'eases/exceptions/duplicatedInclusion.php';
include_once 'eases/exceptions/invalidParams.php';
include_once 'eases/exceptions/nullArguments.php';
include_once 'eases/exceptions/nullParams.php';
include_once 'eases/exceptions/unsetParentheses.php';
include_once 'eases/exceptions/wrongInclusion.php';

/**
 * Retrieve the main configuration file for the eases.
 */

 // eases configuration file.
include_once 'config/core.php';

/**
 * Retrieve the core error logic related to ease code.
 */

// Core line ease error class.
include_once 'error_logic/easeErr/line-err/ease-line-err.php';

// Core block ease error class.
include_once 'error_logic/easeErr/block-err/ease-block-err.php';

// Ease error handler.
include_once 'error_logic/easeErr/ease-errors-handler.php';

// Core ease error enum.
include_once 'error_logic/easeErr/ease-err-enum.php';

/**
 * Retrieve the core logic related to system errors.
 */

// Core system error enum.
include_once 'error_logic/systemErr/sys-err-enum.php';

// Core system error handler.
include_once 'error_logic/systemErr/sys-err-handler.php';

/**
 * Retrieve the core logic related to PHP errors.
 */

include_once 'error_logic/PHPErr/abort_file.php';

/**
 * Retrieve the core logic of the ease engine.
 */

// Parsed Content Buffer.
include_once 'Engine/buffer/parsed-buffer-manger.php';

// Included file Buffer.
include_once 'Engine/buffer/included-file-buffer.php';

// Shared buffer manager.
include_once 'Engine/buffer/mainBuffer.php';

// Entry point for the engine.
include_once 'Engine/Summon/entry.php';

// Content fetcher.
include_once 'Engine/Summon/fetcher.php';

// Content parser and extractor.
include_once 'Engine/Summon/extracter.php';

// Constructor for the equivalent PHP file.
include_once 'Engine/Construction/Construct_PHP.php';

// Simple engine caching system.
include_once 'Engine/Optimize/save.php';

// Renderer for a parsed ease file.
include_once 'Engine/Render/render.php';