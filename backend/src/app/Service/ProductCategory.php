<?php
namespace CherryStore\Api\Service;

class ProductCategory extends BaseService
{
  public function __construct()
  {
    $this->model = new \CherryStore\Api\Model\ProductCategory();
  }

  public function insert($category) {
    $parsedCategory = [
      "name" => $category->name,
      "tax" => floatval($category->tax)
    ];
    $this->model->insert($parsedCategory);
  }
}
