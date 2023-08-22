<?php

namespace CherryStore\Api\Service;

use CherryStore\Api\Service\Product as ProductService;
use CherryStore\Api\Service\ProductCategory as ProductCategoryService;
use CherryStore\Api\Model\OrderProduct as OrderProductModel;

class Order extends BaseService
{
  public function __construct()
  {
    $this->model = new \CherryStore\Api\Model\Order();
  }

  public function all()
  {
    $orders = $this->model->all();
    return array_map(function ($order) {
      $orderProductModel = new OrderProductModel();
      $orderProducts = $orderProductModel->getByOrderID($order['id']);
      $order['products'] = $orderProducts;
      return $order;
    }, $orders);
  }

  public function create($products)
  {
    $total = 0;
    $subtotal = 0;
    $taxTotal = 0;

    $orderProducts = $this->setupOrderProducts($products, $subtotal, $taxTotal, $total);

    $this->model->insert([
      "subtotal" => $subtotal,
      "tax_total" => $taxTotal,
      "total" => $total
    ]);

    $createdOrder = $this->model->getLastRow();
    $this->saveOrderProducts($orderProducts, $createdOrder['id']);

    return array_merge($createdOrder, ['products' => $orderProducts]);
  }

  private function setupOrderProducts($products, &$subtotal, &$taxTotal, &$total)
  {
    $orderProducts = [];

    $productService = new ProductService();
    $productCategoryService = new ProductCategoryService();
    foreach ($products as $requestProduct) {
      $product = $productService->getByID($requestProduct->id);
      $productCategory = $productCategoryService->getByID($product['category_id']);

      $orderProductSubtotal = $product['price'] * $requestProduct->quantity;
      $orderProductTaxTotal = round($orderProductSubtotal * ($productCategory['tax'] / 100), 2);
      $orderProductTotal = $orderProductSubtotal + $orderProductTaxTotal;

      $subtotal += $orderProductSubtotal;
      $taxTotal += $orderProductTaxTotal;
      $total += $orderProductTotal;

      $orderProducts[] = [
        'product_id' => $product['id'],
        'product_name' => $product['name'],
        'product_price' => $product['price'],
        'product_tax' => $productCategory['tax'],
        'product_quantity' => $requestProduct->quantity,
        'total' => $orderProductTotal
      ];
    }

    return $orderProducts;
  }

  private function saveOrderProducts($orderProducts, $orderID)
  {
    $orderProductModel = new \CherryStore\Api\Model\OrderProduct();
    foreach ($orderProducts as $orderProduct) {
      $orderProduct['order_id'] = $orderID;
      $orderProductModel->insert($orderProduct);
    }
  }
}
