<?php

namespace CherryStore\Api\Route;

class ProductCategory extends \CherryStore\Api\Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new \CherryStore\Api\Controller\ProductCategory();
    $middleware = new \CherryStore\Api\Middleware\ProductCategory();
    $productController = new \CherryStore\Api\Controller\Product();

    $this->addNewRoute("GET", "product-category", array($controller, 'all'));
    $this->addNewRoute("POST", "product-category", array($controller, 'insert'), array($middleware, 'validate'));
    $this->addNewRoute("GET", "product-category/:categoryID", array($controller, 'getByID'));
    $this->addNewRoute("PUT", "product-category/:categoryID", array($controller, 'update'), array($middleware, 'checkIfCategoryExists'));
    $this->addNewRoute("DELETE", "product-category/:categoryID", array($controller, 'delete'));
    $this->addNewRoute("GET", "product-category/:categoryID/products", array($productController, 'getByCategoryID'), array($middleware, 'checkIfCategoryExists'));

    $this->setRoutes();
  }
}
