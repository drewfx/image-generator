<?php

namespace App\Handlers;

use Monolog\Logger;
use Slim\Views\Twig;
use Slim\Handlers\AbstractHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotFoundHandler extends AbstractHandler
{
    protected $view;

    public function __construct(Twig $view) {
        $this->view = $view;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {
        $contentType = $this->determineContentType($request);
        $output = '';

        /**
         * Return json if request content type is json.
         * Return view if request content type is html.
         *
         * TODO: check abstractHandler for content type and accept status set
         * TODO: return headers appropriate for json response.
         */
        switch ($contentType) {
            case 'application/json':
                $output = $this->responseWithJson($response);
                break;
            case 'text/html':
                $output = $this->responseWithHtml($response);
                break;
        }

        return $output->withStatus(404);
    }

    protected function responseWithJson($response) {
        return $response->withJson([
            'error' => 'Not Found'
        ]);
    }

    protected function responseWithHtml($response) {
        return $this->view->render($response, 'errors/404.twig');
    }
}