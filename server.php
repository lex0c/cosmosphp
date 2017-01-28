<?php

/**
 * PHP alias for starting server for executing manually tests.
 */
if(is_dir((__DIR__) . '/tests') && (file_exists((__DIR__) . '/tests/bootstrap.php'))) {
    echo "Press Ctrl-C to quit.\n";
    echo "Server started on 'http://localhost:9009/'\n";
    shell_exec('php -S localhost:9009 -t tests/');
} else {
    echo "Could not start server.\n";
}
