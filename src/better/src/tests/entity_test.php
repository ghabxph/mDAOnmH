<?php

require(__DIR__ . '/../domain/entity.php');

/**
 * Type: Entity
 * Test: Blog List All
 **/
function test_entity_blog_list_all() {

}

/**
 * Type: Entity
 * Test: Blog list by type
 **/
function test_entity_blog_list_by_type() {

}

/**
 * Type: Entity
 * Test: Blog create
 **/
function test_entity_blog_create($p) {

    // Run target function
    entity_blog_create($p);

    // Prepares statement
    $stmt = db()->prepare('SELECT * FROM blog WHERE title = ?');

    // Binds input to the statement
    $stmt->bind_param('s', $p['title']);

    // Binds result to a variable

    // Executes query
    $stmt->execute();

    // Close statement
    $stmt->close();
}

/**
 * Type: Entity
 * Test: Blog create
 **/
function data_entity_blog_create() {

    $dataset = [
        [
            'title'    => 'Government News',
            'content'  => 'Well, nice content',
            'type'     => 'Government',
            'filename' => ''
        ], [
            'title'    => 'Food News',
            'content'  => 'I\'m hungry.',
            'type'     => 'Food',
            'filename' => ''
        ], [
            'title'    => 'Sports News',
            'content'  => 'Let\'s play.. Uh...',
            'type'     => 'Sports',
            'filename' => ''
        ]
    ];

    run_test('entity_blog_create', $dataset);
}

/**
 * Type: Entity
 * Test: Blog create
 **/
function clean_entity_blog_create($p) {

    // Prepares statement
    $stmt = db()->prepare('
        DELETE FROM blog
        WHERE
            title      = ? AND
            content    = ? AND
            type       = ? AND
            filename   = ?
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
 * Type: Entity
 * Test: Blog List All
 **/
function data_entity_blog_list_all() {

}

/**
 * Type: Entity
 * Test: Blog list by type
 **/
function data_entity_blog_list_by_type() {

}

/**
 * Helper function that runs test with given dataset
 **/
function run_test($name, $dataset) {

    // Loop through dataset
    foreach($dataset as $data) {

        // Runs the test
        call_user_func("test_$name", $data);

        // Runs the cleanup
        call_user_func("clean_$name", $data);
    }
}

/**
 * Runs the test suite
 **/
function entity_run_suite() {
    data_entity_blog_list_all();
    data_entity_blog_list_by_type();
    data_entity_blog_create();
}
