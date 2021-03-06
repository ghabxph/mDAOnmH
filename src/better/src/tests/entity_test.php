<?php

require(__DIR__ . '/../domain/entity.php');
require(__DIR__ . '/test.php');

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
    $status = entity_blog_create($p);

    // Status must be true
    assert_equal(TRUE, $status, 'entity_blog_create($p) should return true');

    // Checks newly inserted data to db
    $stmt = read('SELECT * FROM blog WHERE title = ?', 's', $p, $id, $title, $content, $filename, $type, $created_at);

    // Should return at least 1 value
    assert_equal(TRUE, $stmt->fetch(), 'There should be at least one row');

    // Should be equal to inserted title
    assert_equal($p['title'], $title, 'Should be equal to inserted title');
    assert_equal($p['content'], $content, 'Should be equal to inserted content');
    assert_equal($p['filename'], $filename, 'Should be equal to inserted filename');
    assert_equal($p['type'], $type, 'Should be equal to inserted type');

    // Closes the statement
    $stmt->close();
}

/**
 * Type: Entity
 * Test: Blog create
 **/
function data_entity_blog_create() {

    echo " ~~ Running test for entity_blog_create() ~~ \n";

    $dataset = [
        'Dataset 1: Government News' => [
            'title'    => 'Government News',
            'content'  => 'Well, nice content',
            'type'     => 'Government',
            'filename' => ''
        ],
        'Dataset 2: Food News' => [
            'title'    => 'Food News',
            'content'  => 'I\'m hungry.',
            'type'     => 'Food',
            'filename' => ''
        ],
        'Dataset 3: Sports News' => [
            'title'    => 'Sports News',
            'content'  => 'Let\'s play.. Uh...',
            'type'     => 'Sports',
            'filename' => ''
        ]
    ];

    run_test('entity_blog_create', $dataset);

    echo " ~~ Test done for entity_blog_create() ~~ \n\n";
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
 * Runs the test suite
 **/
function entity_run_suite() {
    echo "--------------------------------------\n";
    echo "Running entity test suite\n";
    echo "--------------------------------------\n";
    data_entity_blog_list_all();
    data_entity_blog_list_by_type();
    data_entity_blog_create();
    echo "``````````````````````````````````````\n";
}
