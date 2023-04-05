<?php

namespace Movies\Plugin;

use Dotenv\Dotenv;
use Movies\PostType\MoviesPostType;
use Movies\PostType\MetaBox;
use Movies\QSS\Client\QssApiClient;

class MoviesPlugin
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_qss_login', array($this, 'handle_qss_login'));

        // Register single template filter
        add_filter('single_template', array($this, 'load_single_template'));

        new MoviesPostType();
       

        new MetaBox();
        

    }

    public function load_single_template($template)
        {
            if (is_singular('movies')) {
                
                    $token = get_transient('qss_access_token');
                    if ($token) {
                        setcookie('qss_access_token', $token, time() + 60 * 60 * 24, '/');
                    }
                    $new_template = plugin_dir_path(__FILE__) . 'Templates/single-movies.php';
                    if ('' != $new_template) {
                        return $new_template;
                    }
                 
                    $new_template = plugin_dir_path(__FILE__) . 'Templates/login-form.php';
                    if ('' != $new_template) {
                        return $new_template;
                    }
                
            }

            return $template;
        }

    public function register_custom_post_types()
    {
        // Register custom post types here

    }

    public function enqueue_scripts($hook)
    {
        // Enqueue scripts and styles here
    }

    public function handle_qss_login()
    {
        $apiClient = new QssApiClient(getenv('QSS_API_BASE_URL'), getenv('QSS_API_EMAIL'), getenv('QSS_API_PASSWORD'));

        try {
            $token = $apiClient->authenticate();

            if ($token) {
                set_transient('qss_access_token', $token, 60 * 60 * 24); // Store token for 24 hours
                wp_send_json_success();
            } else {
                wp_send_json_error();
            }
        } catch (\Exception $e) {
            wp_send_json_error();
        }

        wp_die();
    }

}