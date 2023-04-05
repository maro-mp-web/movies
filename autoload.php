<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load classes from the Movies namespace
spl_autoload_register(function ($class) {
    $prefix = 'Movies\\';
    $base_dir = __DIR__ . '/plugins/movies/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Load classes from the Dotenv namespace
spl_autoload_register(function ($class) {
    $prefix = 'Dotenv\\';
    $base_dir = __DIR__ . '/vendor/vlucas/phpdotenv/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});