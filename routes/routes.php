<?php

use App\Controllers\ArticleController;

$app->group('/', function() {
   $this->get('', ArticleController::class . ':index')->setName('index');
});

$app->group('/create-article', function() {
    $this->get('', ArticleController::class . ':index')->setName('get.article');
    $this->post('', ArticleController::class . ':post')->setName('post.article');
});
