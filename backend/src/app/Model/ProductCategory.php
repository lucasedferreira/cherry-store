<?php

namespace CherryStore\Api\Model;

class ProductCategory extends BaseModel
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "product_categories";
  }

  public function checkIfExists($categoryID)
  {
    return $this->db->createQueryBuilder()
      ->from($this->table)
      ->where('id = ?')
      ->setParameter(0, $categoryID)
      ->setMaxResults(1)
      ->fetchAllAssociative();
  }
}
