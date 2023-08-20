<?php

namespace CherryStore\Api\Controller;

use CherryStore\Api\Service\ProductCategory as Service;
use CherryStore\Api\Model\ProductCategory as Model;

class ProductCategory extends BaseController
{
  public function all()
  {
    $categories = (new Service())->all();
    $this->response("200", json_encode($categories));
  }

  public function insert($category)
  {
    $service = new Service();
    $result = $service->insert($category);
    if ($result)
      $this->response("201", "Category successuly created.");
  }

  public function update($params, $category)
  {
    $categoryID = $params['categoryID'];
    $service = new Service();
    $result = $service->update($categoryID, $category);
    if ($result) $this->response("200", "Category successuly updated.");
    else $this->response("500", "Error when updating category.");
  }

  public function delete($params)
  {
    $categoryID = $params['categoryID'];
    $model = new Model();
    $result = $model->delete($categoryID);
    if ($result) $this->response("200", "Category successuly deleted.");
    else $this->response("404", "Category does not exist.");
  }
}
