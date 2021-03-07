<?php

// MySQLi Singleton Instance
$_mysqli_inst = NULL;

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

/**
 * Entity: Blog
 * Action: Create
 **/
function entity_blog_create($p) {

    // Creates new blog entry
    return write('
        INSERT INTO blog SET
            title      = ?,
            content    = ?,
            type       = ?,
            filename   = ?,
            created_at = NOW()',
          'ssss',
          $p['title'],
          $p['content'],
          $p['type'],
          $p['filename']
    );
}

/**
 * Type: Helper
 * Description: Returns singleton instance of mysqli connection object
 **/
function db(): mysqli {
    global $_mysqli_inst;

    if ($_mysqli_inst === NULL) {

        // Creates mysqli instance
        $_mysqli_inst = @new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

        // Check if instance has error
        if ($_mysqli_inst->connect_errno) {

            // Show error
            echo "Connect failed: " . $_mysqli_inst->connect_error;

            // Throw error
            throw new Exception(@$_mysqli_inst->error);
        }
    }

    return $_mysqli_inst;
}

/**
 * Type: Helper
 * Description: Reads something in to the database
 **/
function read($query, $types = NULL, $params, &...$results) {

    // Prepares statement
    $stmt = db()->prepare($query);

    // Check if there are parameters
    if (is_string($types)) {

        // Count number of items to remove
        $remove = count($params) - strlen($types);

        // Remove n number of values from the last elements
        $params = $remove === 0 ? $params : array_splice($params, 0, -$remove);

        // Binds parameters
        $stmt->bind_param($types, ...array_values($params));
    }

    // Executes statement
    $stmt->execute();

    // Check if there are results
    if (count($results) > 0) {
        $stmt->bind_result(...$results);
    }

    return $stmt;
}

/**
 * Type: Helper
 * Description: Write something in to the database
 **/
function write($query, $types = NULL, ...$params) {

    // Prepares statement
    $stmt = db()->prepare($query);

    // Check if there are parameters
    if (is_string($types)) {

        // Count number of items to remove
        $remove = count($params) - strlen($types);

        // Remove n number of values from the last elements
        $params = $remove === 0 ? $params : array_splice($params, 0, -$remove);

        // Binds parameters
        $stmt->bind_param($types, ...$params);
    }

    // Executes query
    $r = $stmt->execute();

    // Close statement
    $stmt->close();

    return $r;
}
