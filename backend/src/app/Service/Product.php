<?php

namespace CherryStore\Api\Service;

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

  public function checkIfExists($categoryID)
  {
    $parentModel = new \CherryStore\Api\Model\ProductCategory();
    $result = $parentModel->checkIfExists($categoryID);
    if (count($result) === 0) return false;
    return true;
  }
}
