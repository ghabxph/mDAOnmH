<?php

require (__DIR__ . '/controller.php');
require (__DIR__ . '/../view.php');

if (!function_exists('gateway_blog_list_all')) {
    /**
     * Entity: Blog
     * Action: List all
     **/
    function gateway_blog_list_all() {

        // Returns all blog items
        controller_response(controller_blog_list_all());
    }
}

if (!function_exists('gateway_blog_list_by_type')) {
    /**
     * Entity: Blog
     * Action: List by type
     **/
    function gateway_blog_list_by_type(array $parameters) {

        // Returns all blog items
        controller_response(controller_blog_list_by_type(...get_params($parameters, 'filter')));
    }
}

if (!function_exists('gateway_blog_create')) {
    /**
     * Entity: Blog
     * Action: Create blog
     **/
    function gateway_blog_create(array $parameters) {

        // Returns all blog items
        controller_response(controller_blog_create(get_params($parameters, 'title', 'content', 'type', 'filename')));
    }
}

if (!function_exists('gateway_create_news_view')) {
    /**
     * View: create-news.view.php
     * Description: Simply renders create-news view
     **/
    function gateway_create_news_view($p) {
        controller_response([
            'view' => [
                'view'      => 'create-news',
                'variables' => ''
            ]
        ]);
    }
}

if (!function_exists('controller_response')) {
    /**
     * Helper function that parses controller's return value
     **/
    function controller_response(array $response) {

        // Set HTTP Status
        http_response_code($response['status']);

        // Check if redirect
        if (isset($response['redirect'])) {

            // Let's do redirect and skip view rendering.
            header('Location: ' . $response['redirect']);

            // Exit the function
            return;
        }

        // Serves the view
        view($response);
    }
}

if (!function_exists('get_params')) {
    /**
     * Helper function that gets parameters from given variable
     **/
    function get_params(array $var, string ...$params) {

        // Does my desired magic.
        return array_values(array_intersect_key(array_replace(array_flip($params), $var), array_flip($params)));
    }
}
