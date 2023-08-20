<?php

namespace CherryStore\Api\Middleware;
use CherryStore\Api\Service\ProductCategory as Service;

class ProductCategory extends BaseMiddleware
{
  public function __construct()
  {
    $this->requiredFields = ['name', 'tax'];
  }

  public function checkIfCategoryExists($params)
  {
    $categoryID = $params['categoryID'];
    $service = new Service();
    if ($service->checkIfExists($categoryID)) return;
    $this->returnError("Category does not exist.");
  }
}
