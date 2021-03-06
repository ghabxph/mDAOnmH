<?php

require(__DIR__ . '/../domain/entity.php');
require(__DIR__ . '/test.php');

/**
 * Type: Entity
 * Test: Blog List All
 **/
function test_entity_blog_list_all(string $name) {

}

/**
 * Type: Entity
 * Test: Blog list by type
 **/
function test_entity_blog_list_by_type(string $name) {

}

/**
 * Type: Entity
 * Test: Blog create
 **/
function test_entity_blog_create(string $name) {
    run_test($name)
        ->test(function($p) {
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
        })
        ->dataset([
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
        ])
        ->cleanup(function($p){

            // Removes the created data
            write('DELETE FROM blog WHERE title = ?', 's', ...array_values($p));
        })
        ->run();
}

// Run tests in this script
run_tests(get_defined_functions(), 'entity');
