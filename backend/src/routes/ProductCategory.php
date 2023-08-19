<?php
namespace CherryStore\Api\Route;

class ProductCategory extends Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new ProductCategoryController();
    $this->addNewRoute("GET", "product-category", array($controller, 'getAll'));
    // $this->addNewRoute("POST", "teste", "Este é um POST");

    $this->setRoutes();
  }
}