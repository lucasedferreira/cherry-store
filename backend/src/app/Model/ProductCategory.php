<?php

namespace CherryStore\Api\Model;

class ProductCategory extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "product_categories";
  }
}
