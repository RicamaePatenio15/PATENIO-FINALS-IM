<?php
require 'vendor/autoload.php';

use Aries\MiniFrameworkStore\Models\Product;

session_start();

if (!isset($_POST['productId']) || !isset($_POST['quantity'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}

$product_id = intval($_POST['productId']);
$quantity = intval($_POST['quantity']);

if ($quantity <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid quantity']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$product = new Product();
$productDetails = $product->getById($product_id);

if (!$productDetails) {
    echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    exit;
}

// Ensure the cart only includes product ID and quantity
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    $_SESSION['cart'][$product_id]['total'] = $_SESSION['cart'][$product_id]['quantity'] * $productDetails['price'];
} else {
    $_SESSION['cart'][$product_id] = [
        'product_id' => $product_id,
        'quantity' => $quantity,
        'name' => $productDetails['name'],
        'price' => $productDetails['price'],
        'image_path' => $productDetails['image_path'],
        'total' => $productDetails['price'] * $quantity
    ];
}

echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);