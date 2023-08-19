<?php

namespace CherryStore\Api;

class Router
{
  public $routes = array();

  public function __construct()
  {
    foreach (glob(__DIR__ . "/*.php") as $path) {
      $filename = pathinfo($path, PATHINFO_FILENAME);
      if ($filename === "Router") continue;
      new ("CherryStore\Api\\" . $filename)();
    }
  }

  public function addNewRoute($method, $route, $resouce)
  {
    $route = array(
      "route" => $route,
      "method" => $method,
      "resouce" => $resouce
    );
    array_push($this->routes, $route);
  }

  public function setRoutes()
  {
    $arrayStringURL = explode("/", $_SERVER['REQUEST_URI']);
    $method = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $key => $route) {
      if ($arrayStringURL[1] == $route['route'] && $method == $route['method']) {
        call_user_func(array($route['resouce'][0], $route['resouce'][1]));
      }
    }
  }
}
