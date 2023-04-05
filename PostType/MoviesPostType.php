<?php

namespace Movies\PostType;

class MoviesPostType
{
    public function __construct()
    {
        add_action('init', array($this, 'register_post_type'));
    }

    public function register_post_type()
    {
        $labels = array(
            'name' => __('Movies', 'textdomain'),
            'singular_name' => __('Movie', 'textdomain'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-video-alt3',
            'supports' => array('title', 'editor'),
        );

        register_post_type('movies', $args);
    }
}