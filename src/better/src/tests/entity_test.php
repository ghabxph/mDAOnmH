<?php

require(__DIR__ . '/../domain/entity.php');
require(__DIR__ . '/test.php');

/**
 * Type: Entity
 * Test: Blog List All
 **/
function test_entity_blog_list_all(string $name) {
    run_test($name)
        ->prepare(function($p) {

            // Create new blog titles
            foreach($p as $item) {

                // Create blog entry
                write(
                    'INSERT INTO blog SET title = ?, type = ?, created_at = NOW()',
                    'ss', $item['title'], $item['type']
                );
            }
        })
        ->test(function($p) {

            // Run target function
            $stmt = entity_blog_list_all($id, $title, $content, $filename, $type, $created_at);

            foreach ($p as $expected) {

                // Fetches from statement
                assert_equal(TRUE, $stmt->fetch(), "Fetching $expected_title");

                // Validates
                assert_equal($expected['type'], $type, "We should get our expected type: $type");
                assert_equal($expected['title'], $title, "We should get our expected title: $title");
            }
        })
        ->dataset([
            'Dataset 1: Government and Sports News' => [
                [
                    'type'  => 'Government',
                    'title' => 'Covid19 Response'
                ],
                [
                    'type'  => 'Sports',
                    'title' => 'DotA2'
                ],
                [
                    'type'  => 'Government',
                    'title' => 'Humanitarian Services'
                ],
                [
                    'type'  => 'Government',
                    'title' => 'Important Announcement'
                ],
            ]
        ])
        ->cleanup(function($p) {

            // Performing cleanup
            foreach($p as $item) {

                // Removes the created data
                write(
                    'DELETE FROM blog WHERE title = ? AND type = ?',
                    'ss', $item['title'], $item['type']
                );
            }
        })
        ->run();
}

/**
 * Type: Entity
 * Test: Blog list by type
 **/
function test_entity_blog_list_by_type(string $name) {
    run_test($name)
        ->prepare(function($p) {

            // Create new blog titles
            foreach($p['expected'] as $item) {

                // Create blog entry
                write('INSERT INTO blog SET title = ?, type = ?, created_at = NOW()', 'ss', $item, $p['filter']);
            }
        })
        ->test(function($p) {

            // Run target function
            $stmt = entity_blog_list_by_type($p['filter'], $id, $title, $content, $filename, $type, $created_at);

            foreach ($p['expected'] as $expected_title) {

                // Fetches from statement
                assert_equal(TRUE, $stmt->fetch(), "Fetching $expected_title");

                // Validates
                assert_equal($expected_title, $title, "We should get $title");
            }
        })
        ->dataset([
            'Dataset 1: Government News' => [
                'filter' => 'Government',
                'expected' => ['Covid19 Response', 'Humanitarian Services', 'Important Announcement']
            ],
            'Dataset 2: Sports News' => [
                'filter' => 'Sports',
                'expected' => ['DotA2', 'MLBB', 'Eh']
            ]
        ])
        ->cleanup(function($p) {

            // Performing cleanup
            foreach($p['expected'] as $item) {

                // Removes the created data
                write('DELETE FROM blog WHERE title = ? AND type = ?', 'ss', $item, $p['filter']);
            }
        })
        ->run();
}

/**
 * Type: Entity
 * Test: Blog create
 **/
function test_entity_blog_create(string $name) {
    run_test($name)
        ->prepare(function($p) {})
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
