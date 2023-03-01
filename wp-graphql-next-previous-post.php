<?php
/**
 * Plugin Name: WPGraphQL Previous Next Post
 * Plugin URI: https://github.com/kahnu044/wp-graphql-previous-next-post
 * Description: Adds post type for previous and next post field
 * Requires at least: 5.2
 * Requires PHP: 7
 * Author: Kahnu
 * Author URI: https://github.com/kahnu044
 * Version: 0.1
 */

if (!\class_exists('\WPGraphQL\Extensions\PreviousNextPost')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Load the actual plugin code
\WPGraphQL\Extensions\PreviousNextPost\Loader::init();
