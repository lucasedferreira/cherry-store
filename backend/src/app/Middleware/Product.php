<?php

namespace CherryStore\Api\Middleware;
use CherryStore\Api\Service\Product as Service;

class Product extends BaseMiddleware
{
  public function __construct()
  {
    $this->requiredFields = ['name', 'price', 'categoryID'];
  }

  public function checkIfCategoryExists($product) {
    $service = new Service();
    if($service->checkIfExists($product->categoryID)) return;
    $this->returnError("Category does not exist.");
  }
}
