<?php
namespace CherryStore\Api\Route;

class ProductCategory extends \CherryStore\Api\Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new \CherryStore\Api\Controller\ProductCategory();
    $middleware = new \CherryStore\Api\Middleware\ProductCategory();

    $this->addNewRoute("GET", "product-category", array($controller, 'all'));
    $this->addNewRoute("POST", "product-category", array($controller, 'insert'), array($middleware, 'validate'));
    $this->addNewRoute("DELETE", "product-category/:categoryID", array($controller, 'delete'));

    $this->setRoutes();
  }
}