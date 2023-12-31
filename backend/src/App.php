<?php

namespace CherryStore\Api;

class App
{
  private static DB $db;

  public static function db(): DB
  {
    return static::$db;
  }

  public function boot(): static
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");

    // $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    // $dotenv->load();

    // $this->config = new Config($_ENV);

    static::$db = new DB([
      'dbname' => 'store',
      'user' => 'postgres',
      'password' => 'changeme',
      'host' => 'db',
      'driver' => 'pdo_pgsql'
    ]);

    new Router();

    return $this;
  }
}
