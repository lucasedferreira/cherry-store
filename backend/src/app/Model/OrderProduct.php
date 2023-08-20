<?php

namespace CherryStore\Api\Model;

class OrderProduct extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "order_products";
  }

  public function getByOrderID($orderID)
  {
    return $this->db->createQueryBuilder()
      ->from($this->table)
      ->select("*")
      ->where('order_id = ?')
      ->setParameter(0, $orderID)
      ->fetchAllAssociative();
  }
}
