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
    foreach ($this->routes as $route) {
      $matched = $this->checkIfRouteMatchURL($route);
      if ($matched)
        $this->runRoute($route);
    }
  }

  private function checkIfRouteMatchURL(&$route)
  {
    $arrayURL = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method !== $route['method']) {
      return false;
    }

    $routes = explode("/", $route['route']);
    if (sizeof($routes) !== sizeof($arrayURL))
      return false;

    $route['params'] = [];
    foreach ($arrayURL as $key => $url) {
      if (isset($routes[$key][0]) && $routes[$key][0] === ":") {
        $route['params'][substr($routes[$key], 1)] = $url;
      } else if (!isset($routes[$key]) || $routes[$key] !== $url) {
        // var_dump($routes[$key], $url);
        return false;
      }
    }

    return true;
  }

  private function runRoute($route)
  {
    $request = json_decode(file_get_contents('php://input'));
    $params = [];
    if ($route['params']) $params[] = $route['params'];
    if ($request) $params[] = $request;
    $this->runMiddlewares($route['middleware'], $params);
    call_user_func(array($route['resouce'][0], $route['resouce'][1]), ...$params);
  }

  private function runMiddlewares($middlewares, $params)
  {
    if (is_null($middlewares)) return;

    if (is_array($middlewares[0])) {
      foreach ($middlewares as $middleware) {
        call_user_func(array($middleware[0], $middleware[1]), ...$params);
      }
      return;
    }

    call_user_func(array($middlewares[0], $middlewares[1]), ...$params);
  }
}
