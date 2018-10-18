<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response) {
    // Render index view
    return $this->view->render($response, '/pages/index.twig');
});

$app->post('/create-article', function (Request $request, Response $response) {
    $this->logger->info("Submitted");

    dump($request->getParams());
    die;
});
