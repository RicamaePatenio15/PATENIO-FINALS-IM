<?php
   
   require 'vendor/autoload.php';

    use Aries\MiniFrameworkStore\Models\Product;

    session_start();

    $product_id = intval($_POST['productId']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

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

    if (isset($_SESSION['cart'][$product_id])) {
        // Update quantity if product is already in cart
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        $_SESSION['cart'][$product_id]['total'] = $productDetails['price'] * $_SESSION['cart'][$product_id]['quantity'];
        $message = 'Product quantity updated in cart';
    } else {
        // Ensure the cart only includes product ID and quantity
        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'name' => $productDetails['name'],
            'price' => $productDetails['price'],
            'image_path' => $productDetails['image_path'],
            'total' => $productDetails['price'] * $quantity
        ];
        
        $message = 'Product added to cart';
    }

    echo json_encode(['status' => 'success', 'message' => $message]);

?>