<?php

require (__DIR__ . '/entity.php');

if (!function_exists('controller_blog_list_all')) {
    /**
     * Entity: Blog
     * Action: List all
     **/
    function controller_blog_list_all() {

        // Get all blog items
        $blog = util_get_blog_items(function(&$id, &$title, &$content, &$filename, &$type, &$created_at) {
            return entity_blog_list_all($id, $title, $content, $filename, $type, $created_at);
        });

        // Return 404 if there were no blog entries.
        if (count($blog) === 0) {
            return [
                'status'  => 404,
                'message' => 'No blog entries.',
                'blog'    => $blog
            ];
        }

        // Return 200 if there are entrie(s)
        return [
            'status'  => 200,
            'message' => '',
            'blog'    => $blog
        ];
    }
}

if (!function_exists('controller_blog_list_by_type')) {
    /**
     * Entity: Blog
     * Action: List by type
     **/
    function controller_blog_list_by_type(string $filter) {

        // Get all blog items within given filter
        $blog = util_get_blog_items(function(&$id, &$title, &$content, &$filename, &$type, &$created_at) {
            return entity_blog_list_by_type($filter, $id, $title, $content, $filename, $type, $created_at);
        });

        // Return 404 if there were no blog entries.
        if (count($blog) === 0) {
            return [
                'status'  => 404,
                'message' => 'Oops no entry for this type!',
                'blog'    => $blog
            ];
        }

        // Return 200 if there are entrie(s)
        return [
            'status'  => 200,
            'message' => '',
            'blog'    => $blog
        ];
    }
}

if (!function_exists('controller_blog_create')) {
    /**
     * Entity: Blog
     * Action: Create blog
     **/
    function controller_blog_create($p) {

        return entity_blog_create($p) ? [
            'status'  => 200,
            'message' => $p['title'] . ': has been created.'
        ] : [
            'status'  => 400,
            'message' => 'Bad request. Please check your parameters.',
            'guide'   => [
                'title'    => '(string) Blog title',
                'content'  => '(string) Content',
                'type'     => '(string) Category: Government, Sports, Food',
                'filename' => '(string) Name of uploaded image'],
            'submitted' => $p
        ];
    }
}


if (!function_exists('util_get_blog_items')) {
    /**
     * Util function that gets blog items from given closure
     **/
    function util_get_blog_items(Closure $get_blog_from_entity) {

        // Create empty blog array
        $blog = [];

        $stmt = $get_blog_from_entity($id, $title, $content, $filename, $type, $created_at);

        // Loop through all results
        while ($stmt->fetch()) {

            // Set item to variable
            $blog[] = [
                'id'         => $id,
                'title'      => $title,
                'content'    => $content,
                'filename'   => $filename,
                'type'       => $type,
                'created_at' => $created_at
            ];
        }

        return $blog;
    }
}
