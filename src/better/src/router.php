<?php

if (!function_exists('route')) {
    /**
     * Decides what gateway to call based on method and parameters submitted
     **/
    function route(string $method, array $parameters, string $target_gateway) {

        // Check if target request method matches
        if ($_SERVER['REQUEST_METHOD'] !== $method) {

            // Exits the function.
            return;
        }

        // Method to check
        $method = "_$method";

        // Flips values to keys
        $parameters = array_flip($parameters);

        // Returns the intersection of sent request and target parameters
        $match = array_intersect_key($GLOBALS[$method], $parameters);

        // Move to next route if route condition do not match.
        if (count($parameters) !== count($match)) {

            // Exits the function
            return;
        }

        // Runs the gateway.
        $target_gateway($GLOBALS[$method]);

        // Exit the script to make sure we only render one page.
        exit();
    }
}
