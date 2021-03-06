<?php

require(__DIR__ . '/tests/controller_test.php');
require(__DIR__ . '/tests/entity_test.php');
require(__DIR__ . '/tests/gateway_test.php');

// Runs entity test suite
entity_run_suite();

// Runs controller test suite
controller_run_suite();

// Runs gateway test suite
gateway_run_suite();
