<?php

if (!function_exists('view')) {

    /**
     * Renders target page from given response.
     **/
    function view(array $response) {

        // Escaper (alias of htmlspecialchars)
        function e($unsafe) { return htmlspecialchars($unsafe); }

        // Variable named $data that is going to be available for the target view.
        $data = $response['view']['variables'];

        // Serves target view
        require(__DIR__ . '/view/' . $response['view']['view'] . '.view.php');
    }
}
