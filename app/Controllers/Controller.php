<?php

namespace App\Controllers;

use Interop\Container\ContainerInterface;

class Controller
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property) {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
        return false;
    }
}