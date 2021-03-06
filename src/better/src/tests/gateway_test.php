<?php

require(__DIR__ . '/../domain/gateway.php');
require(__DIR__ . '/test.php');

// Run tests in this script
run_tests(get_defined_functions(), 'gateway');
