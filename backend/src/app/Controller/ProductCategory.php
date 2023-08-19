<?php

namespace CherryStore\Api\Controller;

use CherryStore\Api\Service\ProductCategory as Service;

class ProductCategory extends BaseController
{
  public function all()
  {
    $categories = (new Service())->all();
    echo json_encode($categories);
  }

  public function insert($category)
  {
    $service = new Service();
    $result = $service->insert($category);
    if ($result)
      $this->response("201", "Category successuly created.");
  }
}
