<?php

namespace CherryStore\Api\Model;

class ProductCategory extends BaseModel
{
  public function all()
  {
    return $this->db->createQueryBuilder()
      ->select('id', 'name')
      ->from('product_categories')
      ->fetchAllAssociative();
  }
}
