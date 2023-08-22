<?php

namespace CherryStore\Api\Service;

use CherryStore\Api\Model\Product as ProductModel;

class ProductCategory extends BaseService
{
  public function __construct()
  {
    $this->model = new \CherryStore\Api\Model\ProductCategory();
  }

  public function all()
  {
    $categories = $this->model->all();

    return array_map(function ($category) {
      $productModel = new ProductModel();
      $category['products'] = $productModel->getByCategoryID($category['id']);
      return $category;
    }, $categories);
  }

  public function getByID($categoryID)
  {
    $result = $this->model->getByID($categoryID);
    if (!$result || sizeof($result) === 0) return null;
    $category = $result[0];

    $productModel = new ProductModel();
    $products = $productModel->getByCategoryID($categoryID);

    return array_merge($category, ['products' => $products]);
  }

  public function insert($category)
  {
    $parsedCategory = [
      "name" => $category->name,
      "tax" => floatval($category->tax)
    ];
    $this->model->insert($parsedCategory);
    return $this->model->getLastRow();
  }

  public function update($categoryID, $category)
  {
    $parsedCategory = [];

    if (isset($category->name) && $category->name !== "")
      $parsedCategory['name'] = trim($category->name);

    if (isset($category->tax))
      $parsedCategory['tax'] = floatval($category->tax);

    return $this->model->update($categoryID, $parsedCategory);
  }
}
