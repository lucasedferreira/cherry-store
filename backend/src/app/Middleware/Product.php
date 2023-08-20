<?php

namespace CherryStore\Api\Middleware;

use CherryStore\Api\Service\Product as Service;
use CherryStore\Api\Service\ProductCategory as CategoryService;

class Product extends BaseMiddleware
{
  public function __construct()
  {
    $this->requiredFields = ['name', 'price', 'categoryID'];
  }

  public function checkIfCategoryExists($product)
  {
    $categoryService = new CategoryService();
    if ($categoryService->checkIfExists($product->categoryID)) return;
    $this->returnError("Category does not exist.");
  }

  public function checkIfProductExists($params)
  {
    $productID = $params['productID'];
    $service = new Service();
    if ($service->checkIfExists($productID)) return;
    $this->returnError("Product does not exist.");
  }
}
