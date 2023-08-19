<?php
namespace CherryStore\Api\Route;

class Product extends \CherryStore\Api\Router
{
  public $routes = array();

  public function __construct()
  {
    $controller = new \CherryStore\Api\Controller\Product();
    $this->addNewRoute("GET", "teste", array($controller, 'test'));
    // $this->addNewRoute("POST", "teste", "Este é um POST");

    $this->setRoutes();
  }
}