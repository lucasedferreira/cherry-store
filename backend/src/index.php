<?php
namespace CherryStore\Api;
require_once __DIR__ . '/../vendor/autoload.php';

// $router = new Router();

// $conn = \Doctrine\DBAL\DriverManager::getConnection([
//   'dbname' => 'store',
//   'user' => 'postgres',
//   'password' => 'changeme',
//   'host' => 'db',
//   'driver' => 'pdo_pgsql'
// ]);

$app = new App();
$app->boot();

$categoryModel = new Model\ProductCategory();
$categories = $categoryModel->all();
var_dump($categories);