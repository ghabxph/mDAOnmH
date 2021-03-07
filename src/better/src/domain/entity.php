<?php

require (__DIR__ . '/../driver/db.php');

// MySQLi Singleton Instance
$_mysqli_inst = NULL;

if (!function_exists('entity_blog_list_all')) {
    /**
     * Entity: Blog
     * Action: List All
     **/
    function entity_blog_list_all(&$id, &$title, &$content, &$filename, &$type, &$created_at) {

        // Lists all blog items
        return read(
            'SELECT * FROM blog ORDER BY created_at DESC',
            NULL, [], $id, $title, $content, $filename, $type, $created_at
        );
    }
}

if (!function_exists('entity_blog_list_by_type')) {
    /**
     * Entity: Blog
     * Action: List by type
     **/
    function entity_blog_list_by_type(string $filter, &$id, &$title, &$content, &$filename, &$type, &$created_at) {

        // Lists blog items by type
        return read(
            'SELECT * FROM blog WHERE type = ? ORDER BY created_at DESC',
            's', [$filter],
            $id, $title, $content, $filename, $type, $created_at
        );

    }
}

if (!function_exists('entity_blog_create')) {
    /**
     * Entity: Blog
     * Action: Create
     **/
    function entity_blog_create(string $title, string $content, string $type, string $filename) {

        // Creates new blog entry
        return write('
        INSERT INTO blog SET
            title      = ?,
            content    = ?,
            type       = ?,
            filename   = ?,
            created_at = NOW()',
          'ssss',
          $title,
          $content,
          $type,
          $filename
        );
    }
}
