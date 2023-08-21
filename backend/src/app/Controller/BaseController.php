<?php

namespace CherryStore\Api\Controller;

class BaseController
{
  public function response($status, $message = "")
  {
    http_response_code($status);
    header("Content-Type: application/json; charset=utf-8;");
    echo $message;
  }
}
