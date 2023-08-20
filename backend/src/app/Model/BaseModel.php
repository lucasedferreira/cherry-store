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

  public function getByID($id)
  {
    return $this->db->createQueryBuilder()
      ->from($this->table)
      ->select("*")
      ->where('id = ?')
      ->setParameter(0, $id)
      ->setMaxResults(1)
      ->fetchAllAssociative();
  }

  public function insert($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function getLastRow()
  {
    $lastRow = $this->db->createQueryBuilder()
      ->select('*')
      ->from($this->table)
      ->orderBy('id', 'DESC')
      ->setMaxResults(1)
      ->fetchAllAssociative();
    if (!$lastRow || sizeof($lastRow) === 0) return null;
    return $lastRow[0];
  }

  public function update($id, $data)
  {
    $data['updated_at'] = "now()";
    return $this->db->update($this->table, $data, ["id" => $id]);
  }

  public function delete($id)
  {
    return $this->db->delete($this->table, ["id" => $id]);
  }
}
