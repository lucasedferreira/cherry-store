<?php

namespace CherryStore\Api\Service;

class BaseService
{
  protected $model;

  public function all()
  {
    return $this->model->all();
  }

  public function getByID($id)
  {
    $result = $this->model->getByID($id);
    if (!$result || sizeof($result) === 0) return null;
    return $result[0];
  }
}
