<?php

namespace CherryStore\Api\Model;

class Order extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "orders";
  }
}
