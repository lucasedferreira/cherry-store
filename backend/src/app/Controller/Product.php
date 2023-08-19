<?php

namespace CherryStore\Api\Controller;

use CherryStore\Api\Service\Product as Service;

class Product extends BaseController
{
  public function insert($product)
  {
    $service = new Service();
    $result = $service->insert($product);
    if ($result)
      $this->response("201", "Product successuly created.");
  }
}
