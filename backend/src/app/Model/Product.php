<?php

namespace CherryStore\Api\Model;

class Product extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "products";
  }

  public function getByCategoryID($categoryID)
  {
    return $this->db->createQueryBuilder()
      ->from($this->table)
      ->select("*")
      ->where('category_id = ?')
      ->setParameter(0, $categoryID)
      ->orderBy('id', 'ASC')
      ->fetchAllAssociative();
  }
}
