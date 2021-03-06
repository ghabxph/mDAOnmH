<?php

// MySQLi Singleton Instance
$_mysqli_inst = NULL;

/**
 * Entity: Blog
 * Action: List All
 **/
function entity_blog_list_all() {

}

/**
 * Entity: Blog
 * Action: List by type
 **/
function entity_blog_list_by_type() {

}

/**
 * Entity: Blog
 * Action: Create
 **/
function entity_blog_create($p) {

    // Prepares statement
    $stmt = db()->prepare('
        INSERT INTO blog SET
            title      = ?,
            content    = ?,
            type       = ?,
            filename   = ?,
            created_at = NOW()
    ');

    // Binds input to the statement
    $stmt->bind_param(
        'ssss',
        $p['title'],
        $p['content'],
        $p['type'],
        $p['filename'],
    );

    // Executes query
    $stmt->execute();

    // Close statement
    $stmt->close();
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
