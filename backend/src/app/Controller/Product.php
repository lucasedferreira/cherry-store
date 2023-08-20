<?php

namespace CherryStore\Api\Controller;

use CherryStore\Api\Service\Product as Service;
use CherryStore\Api\Model\Product as Model;

class Product extends BaseController
{
  public function all()
  {
    $categories = (new Model())->all();
    $this->response("200", json_encode($categories));
  }

  public function insert($product)
  {
    $service = new Service();
    $result = $service->insert($product);
    if ($result) $this->response("201", "Product successuly created.");
  }

  public function update($params, $product)
  {
    $productID = $params['productID'];
    $service = new Service();
    $result = $service->update($productID, $product);
    if ($result) $this->response("200", "Product successuly updated.");
    else $this->response("500", "Error when updating product.");
  }

  public function delete($params)
  {
    $productID = $params['productID'];
    $model = new Model();
    $result = $model->delete($productID);
    if ($result) $this->response("200", "Product successuly deleted.");
    else $this->response("404", "Product does not exist.");
  }
}
