<?php

namespace CherryStore\Api\Model;

class Product extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "products";
  }
}