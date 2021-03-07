<?php

require(__DIR__ . '/../router.php');
require(__DIR__ . '/../domain/gateway.php');

route('POST', ['title', 'content', 'type'], 'gateway_blog_create');
route('GET', [], 'gateway_create_news_view');
