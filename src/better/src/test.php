<?php

// Set the test environment
$_ENV['DB_NAME'] = $_ENV['DB_TEST_NAME'];
$_ENV['DB_USERNAME'] = $_ENV['DB_TEST_USERNAME'];
$_ENV['DB_PASSWORD'] = $_ENV['DB_TEST_PASSWORD'];

// Runs controller test suite
require(__DIR__ . '/tests/controller_test.php');

// Runs entity test suite
require(__DIR__ . '/tests/entity_test.php');

// Runs gateway test suite
require(__DIR__ . '/tests/gateway_test.php');
