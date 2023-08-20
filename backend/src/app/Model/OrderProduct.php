<?php

namespace CherryStore\Api\Model;

class OrderProduct extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "order_products";
  }
}
