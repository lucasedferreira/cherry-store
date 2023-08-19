<?php

namespace CherryStore\Api\Model;

abstract class BaseModel
{
  protected \CherryStore\Api\DB $db;

  public function __construct()
  {
    $this->db = \CherryStore\Api\App::db();
  }
}
