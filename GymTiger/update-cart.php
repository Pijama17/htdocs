<?php
require_once __DIR__.'/includes/init.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$productId = $input['product_id'] ?? 0;
$action = $input['action'] ?? '';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = [
    'success' => false,
    'cart_count' => 0,
    'subtotal' => 0,
    'shipping' => 0,
    'tax' => 0,
    'total' => 0
];

foreach ($_SESSION['cart'] as $key => &$item) {
    if ($item['id'] == $productId) {
        switch ($action) {
            case 'increase':
                $item['quantity']++;
                break;
            case 'decrease':
                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                } else {
                    unset($_SESSION['cart'][$key]);
                }
                break;
            case 'remove':
                unset($_SESSION['cart'][$key]);
                break;
        }
        break;
    }
}

// Re-index array after unset
$_SESSION['cart'] = array_values($_SESSION['cart']);

// Update cart count
$_SESSION['cart_count'] = array_reduce($_SESSION['cart'], function($carry, $item) {
    return $carry + $item['quantity'];
}, 0);

// Calculate totals
$subtotal = array_reduce($_SESSION['cart'], function($carry, $item) {
    return $carry + ($item['price'] * $item['quantity']);
}, 0);

$shipping = $subtotal > 50 ? 0 : 5.99;
$tax = $subtotal * 0.08;
$total = $subtotal + $shipping + $tax;

// Find the updated item to return its new quantity and total
$updatedItem = null;
foreach ($_SESSION['cart'] as $item) {
    if ($item['id'] == $productId) {
        $updatedItem = $item;
        break;
    }
}

$response = [
    'success' => true,
    'cart_count' => $_SESSION['cart_count'],
    'subtotal' => $subtotal,
    'shipping' => $shipping,
    'tax' => $tax,
    'total' => $total,
    'new_quantity' => $updatedItem['quantity'] ?? 0,
    'item_total' => $updatedItem ? $updatedItem['price'] * $updatedItem['quantity'] : 0
];

echo json_encode($response);
exit;