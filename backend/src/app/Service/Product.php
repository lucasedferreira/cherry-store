<?php

namespace CherryStore\Api\Service;

use CherryStore\Api\Service\ProductCategory as CategoryService;

class Product extends BaseService
{
  public function __construct()
  {
    $this->model = new \CherryStore\Api\Model\Product();
  }

  public function insert($product)
  {
    $parsedProduct = [
      "name" => trim($product->name),
      "price" => floatval($product->price),
      "category_id" => intval($product->categoryID)
    ];
    return $this->model->insert($parsedProduct);
  }

  public function update($productID, $product)
  {
    $parsedProduct = [];

    if (isset($product->name) && $product->name !== "")
      $parsedProduct['name'] = trim($product->name);

    if (isset($product->price))
      $parsedProduct['price'] = floatval($product->price);

    if (isset($product->categoryID)) {
      $categoryService = new CategoryService();
      if (!$categoryService->checkIfExists($product->categoryID))
        return false;

      $parsedProduct['category_id'] = $product->categoryID;
    }

    return $this->model->update($productID, $parsedProduct);
  }
}
