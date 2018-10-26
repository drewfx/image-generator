<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, '/pages/index.twig');
    }

    public function post(Request $request, Response $response)
    {
        $input = $request->getParams();

        dump($input);

        if ($this->validated($input)) {
            // do stuff
        }

        // $response, string $template, array $data
        return $this->view->render($response, '');
    }

    protected function validated($input)
    {

    }
}