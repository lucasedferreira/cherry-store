<?php

namespace CherryStore\Api\Service;

class BaseService
{
  protected $model;

  public function all() {
    return $this->model->all();
  }
}
