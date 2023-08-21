<?php

namespace CherryStore\Api\Service;

class ProductCategory extends BaseService
{
  public function __construct()
  {
    $this->model = new \CherryStore\Api\Model\ProductCategory();
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
