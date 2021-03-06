<?php

require('tests/controller_test.php');
require('tests/entity_test.php');
require('tests/gateway_test.php');

// Runs entity test suite
entity_run_suite();

// Runs controller test suite
controller_run_suite();

// Runs gateway test suite
gateway_run_suite();
