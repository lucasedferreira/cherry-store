<?php

namespace CherryStore\Api\Middleware;

class ProductCategory extends BaseMiddleware
{
  public function __construct()
  {
    $this->requiredFields = ['name', 'tax'];
  }
}
