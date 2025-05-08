<?php
/**
 * This function introduce a formated way to display PHP errors into the page.
 * @return void
 */
function abort_if_error() {
    /**
     * REGISTER A CALLBACK FUNCTION AFTER AN ERROR.
     */
    register_shutdown_function(function() {
        if(error_get_last() != null && FORMAT_PHP_ERROR) {
            ob_end_clean();
            http_response_code(500);
            extract(error_get_last());
            include_once "storage/error_view/_php_error.php";
            exit(1);
        }
    });
}

