<?php

namespace CherryStore\Api\Middleware;

class BaseMiddleware
{
  protected $requiredFields = [];

  public function validate($category)
  {
    foreach ($this->requiredFields as $requiredField) {
      if (!isset($category->$requiredField) || $category->$requiredField === "") {
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
