<?php

namespace CherryStore\Api\Route;

class Product extends \CherryStore\Api\Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new \CherryStore\Api\Controller\Product();
    $middleware = new \CherryStore\Api\Middleware\Product();

    $this->addNewRoute("GET", "product", array($controller, 'all'));
    $this->addNewRoute("POST", "product", array($controller, 'insert'), [
      array($middleware, 'validate'),
      array($middleware, 'checkIfCategoryExists')
    ]);
    $this->addNewRoute("PUT", "product/:productID", array($controller, 'update'), array($middleware, 'checkIfProductExists'));
    $this->addNewRoute("DELETE", "product/:productID", array($controller, 'delete'));

    $this->setRoutes();
  }
}
