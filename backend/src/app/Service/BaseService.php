<?php

namespace CherryStore\Api\Service;

class BaseService
{
  protected $model;

  public function all() {
    return $this->model->all();
  }

  public function checkIfExists($id)
  {
    $result = $this->model->checkIfExists($id);
    if (count($result) === 0) return false;
    return true;
  }
}
