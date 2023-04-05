<?php

/*
Plugin Name: Movies
Plugin URI: https://example.com/movies
Description: A WordPress plugin for managing movies.
Version: 1.0
Author: 
Author URI: 
*/

require_once(__DIR__ . '/autoload.php');
require_once(__DIR__ . '/MoviesPlugin.php');
require_once(__DIR__ . '/PostType/MoviesPostType.php');
require_once(__DIR__ . '/PostType/MetaBox.php');
require_once(__DIR__ . '/QSS/Client/QssApiClient.php');




use Movies\Plugin\MoviesPlugin;
use Movies\PostType\MoviesPostType;


new MoviesPlugin();