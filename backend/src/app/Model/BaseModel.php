<?php

namespace CherryStore\Api\Model;

abstract class BaseModel
{
  protected $table;
  protected \CherryStore\Api\DB $db;

  public function __construct()
  {
    $this->db = \CherryStore\Api\App::db();
  }

  public function all()
  {
    return $this->db->createQueryBuilder()
      ->select('*')
      ->from($this->table)
      ->fetchAllAssociative();
  }

  public function delete($id)
  {
    return $this->db->delete($this->table, ["id" => $id]);
  }
}
