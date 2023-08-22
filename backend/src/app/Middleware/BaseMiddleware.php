<?php

namespace CherryStore\Api\Middleware;

class BaseMiddleware
{
  protected $requiredFields = [];

  public function validate($data)
  {
    foreach ($this->requiredFields as $requiredField) {
      if (!isset($data->$requiredField) || $data->$requiredField === "") {
        $this->returnError("Field " . $requiredField . " is required.");
      }
    }
  }

  public function returnError($message)
  {
    header("HTTP/1.1 500 Internal Server Error");
    echo $message;
    die();
  }
}
