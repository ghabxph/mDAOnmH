<?php

if (!class_exists('SimpleTest')) {

    /**
     * Simple test utility class that aids developer to do unit test
     **/
    class SimpleTest {

        private $test_name;
        private $dataset;
        private $cleanup_script;
        private $test_script;

        function __construct(string $test_name) {

            // Sets the name of test function
            $this->test_name = $test_name;
        }

        /**
         * Sets dataset
         *
         * @returns self
         **/
        function dataset($dataset): self {

            // Sets dataset
            $this->dataset = $dataset;

            // Returns instance
            return $this;
        }

        /**
         * Sets cleanup script
         *
         * @returns self
         **/
        function cleanup(Closure $callback): self {

            // Sets cleanup script
            $this->cleanup_script = $callback;

            // Returns instance
            return $this;
        }

        /**
         * Sets the test script
         *
         * @return self
         **/
        function test(Closure $callback): self {

            // Sets test script
            $this->test_script = $callback;

            // Returns instance
            return $this;
        }

        /**
         * Runs the test
         **/
        function run(): void {

            $function_name = $this->test_name . '()';

            echo " ~~ Running test for $function_name ~~ \n";

            // Loop through dataset
            foreach($this->dataset as $dataset_name => $data) {

                echo "    ~ $dataset_name\n";

                // Runs the test
                ($this->test_script)($data);

                // Runs the cleanup
                ($this->cleanup_script)($data);
            }

            echo " ~~ Test done for $function_name ~~ \n";
        }

    }
}

if (!function_exists('run_test')) {

    /**
     * Creates SimpleTest instance
     **/
    function run_test(string $test_name): SimpleTest {

        // Returns new test instance
        return new SimpleTest($test_name);
    }
}

if (!function_exists('assert_equal')) {

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
}


if (!function_exists('run_tests')) {

    /**
     * Runs test in the caller's script
     **/
    function run_tests($defined_functions, $name) {

        echo "--------------------------------------\n";
        echo "Running $name test suite\n";
        echo "--------------------------------------\n";

        // Get tests from caller's script
        $tests = preg_grep("/^test_$name\_[a-zA-Z\_]*$/", $defined_functions['user']);

        // Loops through tests
        foreach ($tests as $run_unit_test)

            // Runs unit test
            $run_unit_test($run_unit_test);


        echo "``````````````````````````````````````\n";
    }
}
