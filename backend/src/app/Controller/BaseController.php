<?php

namespace CherryStore\Api\Controller;

class BaseController
{
  public function __construct()
  {
    // header('Content-Type: application/json; charset=utf-8');
  }

  public function response($status, $message = "")
  {
    header("HTTP/1.1 " . $status);
    echo $message;
  }
}
