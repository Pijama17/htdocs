<?php
require_once __DIR__.'/includes/init.php';

header('Content-Type: application/json');

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    $_SESSION['cart_count'] = 0;
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    
    // Check if product already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    
    // If not found, add new item
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $_POST['product_name'],
            'price' => (float)$_POST['price'],
            'quantity' => 1,
            'image' => $_POST['image'],
            'size' => 'M', // Default size
            'color' => 'Black' // Default color
        ];
    }
    
    // Update cart count
    $_SESSION['cart_count'] = array_reduce($_SESSION['cart'], function($carry, $item) {
        return $carry + $item['quantity'];
    }, 0);
    
    echo json_encode([
        'success' => true,
        'cart_count' => $_SESSION['cart_count']
    ]);
    exit;
}

echo json_encode(['success' => false]);