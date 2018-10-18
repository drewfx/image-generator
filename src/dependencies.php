<?php
// DIC configuration

$container = $app->getContainer();

// twig
$container['view'] = function ($container) {
    $settings = $container->get('settings')['twig'];
    $view = new \Slim\Views\Twig($settings['path'], [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// error handling
$container['notFoundHandler'] = function ($container) {
    return new App\Handlers\NotFoundHandler($container['view']);
};