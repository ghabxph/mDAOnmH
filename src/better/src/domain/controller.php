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
                'view' => [
                    'view'      => 'home',
                    'variables' => $blog
                ],
            ];
        }

        // Return 200 if there are entrie(s)
        return [
            'status'  => 200,
            'message' => '',
            'view' => [
                'view'      => 'home',
                'variables' => $blog
            ],
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
        $blog = util_get_blog_items(function(&$id, &$title, &$content, &$filename, &$type, &$created_at, $extra) {
            return entity_blog_list_by_type($extra[0], $id, $title, $content, $filename, $type, $created_at);
        }, [$filter]);

        // Return 404 if there were no blog entries.
        if (count($blog) === 0) {
            return [
                'status'  => 404,
                'message' => 'Oops no entry for this type!',
                'view' => [
                    'view'      => 'home',
                    'variables' => $blog
                ],
            ];
        }

        // Return 200 if there are entrie(s)
        return [
            'status'  => 200,
            'message' => '',
            'view' => [
                'view'      => 'home',
                'variables' => $blog
            ],
        ];
    }
}

if (!function_exists('controller_blog_create')) {
    /**
     * Entity: Blog
     * Action: Create blog
     **/
    function controller_blog_create($p) {

        // Pre-set filename
        $p[3] = '';

        # Allowed image extensions
        # https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
        $allowed_img = [
            'apng', 'avif', 'gif', 'jpg', 'jpeg', 'jfif',
            'pjpeg', 'pjp', 'png', 'svg', 'webp'
        ];

        // Check if $_FILES is valid and file extension submitted is a valid picture.
        if (is_array($_FILES) && in_array($ext = pathinfo($_FILES['file']['name'])['extension'], $allowed_img)) {

            $max_size = 1024 * 1024 * (int)ini_get('upload_max_filesize');
            $sub_size = (int) $_SERVER['CONTENT_LENGTH'];

            // Check if we hit max file upload
            if ($sub_size > $max_size) {
                die("Max file size has been reached. Max size: $max_size, Submitted size: $sub_size");
            }

            # Generate a filename by hashing the file
            $filename = hash('sha256', file_get_contents($_FILES['file']['tmp_name'])) . ".$ext";

            # Move the uploaded file to upload directory
            move_uploaded_file($_FILES['file']['tmp_name'], '/var/www/uploads/'.$filename);

            # Set filename on $p
            $p[3] = $filename;
        }

        return entity_blog_create(...$p) ? [
            'status'   => 200,
            'message'  => $p['title'] . ': has been created.',
            'redirect' => 'index.php'
        ] : [
            'status'   => 400,
            'message'  => 'Bad request. Please check your parameters.',
            'redirect' => 'create-blog.php',
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
    function util_get_blog_items(Closure $get_blog_from_entity, array $extra = NULL) {

        // Create empty blog array
        $blog = [];

        $stmt = $get_blog_from_entity($id, $title, $content, $filename, $type, $created_at, $extra);

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
