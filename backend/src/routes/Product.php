<?php
namespace CherryStore\Api\Route;

class Product extends Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new ProductController();
    $this->addNewRoute("GET", "teste", array($controller, 'test'));
    // $this->addNewRoute("POST", "teste", "Este é um POST");

    $this->setRoutes();
  }
}