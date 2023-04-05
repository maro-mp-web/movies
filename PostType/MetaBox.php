<?php

namespace Movies\PostType;

class MetaBox
{
    public function __construct()
    {
        add_action('add_meta_boxes_movies', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_meta_data'));
    }

    public function add_meta_box($post)
    {
        add_meta_box(
            'movie-title-meta-box',
            __('Movie Title', 'textdomain'),
            array($this, 'render_meta_box'),
            'movies',
            'normal',
            'default'
        );
    }

    public function render_meta_box($post)
    {
        wp_nonce_field('movie_title_meta_box', 'movie_title_meta_box_nonce');

        $movie_title = get_post_meta($post->ID, 'movie_title', true);

        echo '<label for="movie_title">' . __('Title', 'textdomain') . '</label>';
        echo '<input type="text" id="movie_title" name="movie_title" value="' . esc_attr($movie_title) . '">';
    }

    public function save_meta_data($post_id)
    {
        if (!isset($_POST['movie_title_meta_box_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['movie_title_meta_box_nonce'], 'movie_title_meta_box')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (!isset($_POST['movie_title'])) {
            return;
        }

        $movie_title = sanitize_text_field($_POST['movie_title']);

        update_post_meta($post_id, 'movie_title', $movie_title);
    }
}