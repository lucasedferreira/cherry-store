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
      new ("CherryStore\Api\Route\\" . $filename)();
    }
  }

  public function addNewRoute($method, $route, $resouce, $middleware = null)
  {
    $route = array(
      "route" => $route,
      "method" => $method,
      "resouce" => $resouce,
      "middleware" => $middleware
    );
    array_push($this->routes, $route);
  }

  public function setRoutes()
  {
    $arrayStringURL = explode("/", $_SERVER['REQUEST_URI']);
    $method = $_SERVER['REQUEST_METHOD'];
    $request = json_decode(file_get_contents('php://input'));

    foreach ($this->routes as $route) {
      if ($arrayStringURL[1] == $route['route'] && $method == $route['method']) {
        call_user_func(array($route['middleware'][0], $route['middleware'][1]), $request);
        call_user_func(array($route['resouce'][0], $route['resouce'][1]), $request);
      }
    }
  }
}
