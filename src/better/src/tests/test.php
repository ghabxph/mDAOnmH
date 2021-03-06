<?php

/**
 * Helper function that does assert_equal
 **/
function assert_equal($expects, $actual, $description) {

    if ($expects !== $actual) {
        $status = 'FAIL';
        $result =
                "         - Expected value: \n" .
                "           > " . var_export($expects, true) . "\n" .
                "         - Actual value: \n" .
                "           > " . var_export($actual, true) . "\n";
    } else {
        $status = 'PASS';
    }
    echo "       - $status: $description\n$result";
}

/**
 * Helper function that runs test with given dataset
 **/
function run_test($name, $dataset) {

    // Loop through dataset
    foreach($dataset as $dataset_name => $data) {

        echo "    ~ $dataset_name\n";

        // Runs the test
        call_user_func("test_$name", $data);

        // Runs the cleanup
        call_user_func("clean_$name", $data);
    }
}
