<?php

require(__DIR__ . '/../router.php');
require(__DIR__ . '/../domain/gateway.php');

route('GET', ['filter'], 'gateway_blog_list_by_type');
route('GET', [], 'gateway_blog_list_all');
