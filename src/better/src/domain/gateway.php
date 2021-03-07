<?php

require (__DIR__ . '/controller.php');

if (!function_exists('gateway_blog_list_all')) {
    /**
     * Entity: Blog
     * Action: List all
     **/
    function gateway_blog_list_all() {

        // Returns all blog items
        return controller_response(controller_blog_list_all());
    }
}

if (!function_exists('gateway_blog_list_by_type')) {
    /**
     * Entity: Blog
     * Action: List by type
     **/
    function gateway_blog_list_by_type(string $filter) {

        // Returns all blog items
        return controller_response(controller_blog_list_by_type(...get_params($_GET, 'filter')));
    }
}

if (!function_exists('gateway_blog_create')) {
    /**
     * Entity: Blog
     * Action: Create blog
     **/
    function gateway_blog_create($p) {

        // Returns all blog items
        return controller_response(controller_blog_create(get_params($_POST, 'title', 'content', 'type', 'filename')));
    }
}

if (!function_exists('controller_response')) {
    /**
     * Helper function that parses controller's return value
     **/
    function controller_response(array $response) {
        // Set HTTP Status
        http_response_code($response['status']);

        // Return response
        return $response;
    }
}

if (!function_exists('get_params')) {
    /**
     * Helper function that gets parameters from given variable
     **/
    function get_params(array $var, string ...$params) {

        // Parameters to return
        $p = [];

        // Loop through requested parameters
        foreach ($params as $param) {

            // Returns empty string if variable does not exist
            $p[$param] = isset($var[$param]) ? $var[$param] : '';
        }

        // Return requested parameters
        return $p;
    }
}
