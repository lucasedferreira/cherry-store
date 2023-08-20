<?php

namespace CherryStore\Api\Controller;

use CherryStore\Api\Service\Order as Service;
use CherryStore\Api\Model\Order as Model;

class Order extends BaseController
{
  public function all()
  {
    $orders = (new Service())->all();
    $this->response("200", json_encode($orders));
  }

  public function create($request)
  {
    $service = new Service();
    $order = $service->create($request->products);
    $this->response("201", json_encode($order));
  }
}
