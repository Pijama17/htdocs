<?php
// Set the page title
$pageTitle = 'Your Shopping Cart | Gym Tiger';
$customCSS = 'styles/cart.css';

// Include the header
require_once __DIR__.'/includes/header.php';

// Calculate cart totals
$subtotal = 0;
foreach ($_SESSION['cart'] ?? [] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = $subtotal > 50 ? 0 : 5.99; // Free shipping over $50
$tax = $subtotal * 0.08; // Example 8% tax
$total = $subtotal + $shipping + $tax;
?>

<main class="cart-container">
    <div class="container">
        <h1 class="cart-title">Your Shopping Cart</h1>
        
        <?php if ($_SESSION['cart_count'] > 0): ?>
            <div class="cart-grid">
                <!-- Cart Items -->
                <section class="cart-items">
                    <div class="cart-header">
                        <h2>Products</h2>
                        <span>Price</span>
                    </div>
                    
                    <div id="cart-items-container">
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="cart-item" data-id="<?= $item['id'] ?>">
                            <div class="item-info">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="item-image">
                                <div class="item-details">
                                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                                    <p>Size: <?= htmlspecialchars($item['size']) ?> | Color: <?= htmlspecialchars($item['color']) ?></p>
                                    <div class="item-quantity">
                                        <button class="quantity-btn decrease">-</button>
                                        <span class="quantity"><?= $item['quantity'] ?></span>
                                        <button class="quantity-btn increase">+</button>
                                    </div>
                                    <button class="remove-item">Remove</button>
                                </div>
                            </div>
                            <div class="item-price">$<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                
                <!-- Order Summary -->
                <section class="order-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="cart-subtotal">$<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span id="cart-shipping"><?= $shipping == 0 ? 'FREE' : '$'.number_format($shipping, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span id="cart-tax">$<?= number_format($tax, 2) ?></span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="cart-total">$<?= number_format($total, 2) ?></span>
                        </div>
                    </div>
                    <button class="checkout-btn">Proceed to Checkout</button>
                    <div class="continue-shopping">
                        <a href="products.php"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
                    </div>
                </section>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added anything to your cart yet</p>
                <a href="products.php" class="shop-btn">Shop Now</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity changes and removal
    document.querySelector('#cart-items-container').addEventListener('click', function(e) {
        const itemElement = e.target.closest('.cart-item');
        if (!itemElement) return;
        
        const productId = itemElement.dataset.id;
        let action = null;
        
        if (e.target.classList.contains('decrease')) {
            action = 'decrease';
        } else if (e.target.classList.contains('increase')) {
            action = 'increase';
        } else if (e.target.classList.contains('remove-item')) {
            action = 'remove';
        }
        
        if (!action) return;
        
        updateCartItem(productId, action);
    });
    
    function updateCartItem(productId, action) {
        fetch('update-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                action: action
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the UI based on the response
                if (action === 'remove') {
                    document.querySelector(`.cart-item[data-id="${productId}"]`).remove();
                } else {
                    const quantityElement = document.querySelector(`.cart-item[data-id="${productId}"] .quantity`);
                    quantityElement.textContent = data.new_quantity;
                    
                    const priceElement = document.querySelector(`.cart-item[data-id="${productId}"] .item-price`);
                    priceElement.textContent = '$' + data.item_total.toFixed(2);
                }
                
                // Update summary
                document.querySelector('#cart-subtotal').textContent = '$' + data.subtotal.toFixed(2);
                document.querySelector('#cart-shipping').textContent = data.shipping === 0 ? 'FREE' : '$' + data.shipping.toFixed(2);
                document.querySelector('#cart-tax').textContent = '$' + data.tax.toFixed(2);
                document.querySelector('#cart-total').textContent = '$' + data.total.toFixed(2);
                
                // Update cart count in header
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(el => {
                    el.textContent = data.cart_count;
                    el.style.display = data.cart_count > 0 ? 'flex' : 'none';
                });
                
                // Show empty cart if needed
                if (data.cart_count === 0) {
                    document.querySelector('.cart-grid').innerHTML = `
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <h2>Your cart is empty</h2>
                            <p>Looks like you haven't added anything to your cart yet</p>
                            <a href="products.php" class="shop-btn">Shop Now</a>
                        </div>
                    `;
                }
            }
        });
    }
});
</script>

<?php
// Include the footer
require_once __DIR__.'/includes/footer.php';
?>