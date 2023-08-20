<?php

namespace CherryStore\Api\Route;

class Order extends \CherryStore\Api\Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new \CherryStore\Api\Controller\Order();
    $middleware = new \CherryStore\Api\Middleware\Order();

    $this->addNewRoute("GET", "order", array($controller, 'all'));
    $this->addNewRoute("POST", "order", array($controller, 'create'), [
      array($middleware, 'validate'),
      array($middleware, 'checkIfProductExists')
    ]);
    $this->addNewRoute("DELETE", "order/:orderID", array($controller, 'delete'));

    $this->setRoutes();
  }
}
