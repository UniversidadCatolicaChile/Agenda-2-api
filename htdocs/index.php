<?php

if($_SERVER['REQUEST_URI'] == '/'){
    header('Location: https://www.uc.cl/agenda/');
    exit();
}

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require dirname(__FILE__).'/cms/wp-blog-header.php';
