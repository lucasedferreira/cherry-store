<?php

namespace CherryStore\Api\Middleware;

use CherryStore\Api\Service\Order as Service;
use CherryStore\Api\Service\Product as ProductService;

class Order extends BaseMiddleware
{
  public function __construct()
  {
    $this->requiredFields = ['products'];
  }

  public function checkIfOrderExists($product)
  {
    $categoryService = new CategoryService();
    if ($categoryService->getByID($product->categoryID)) return;
    $this->returnError("Category does not exist.");
  }

  public function checkIfProductExists($request)
  {
    $products = $request->products;
    $productService = new ProductService();
    foreach ($products as $product) {
      if ($productService->getByID($product->id)) continue;
      $this->returnError("One of the products does not exist.");
    }
  }
}
