<?php
require_once __DIR__.'/includes/init.php';
$pageTitle = 'Products | Gym Tiger';
$customCSS = 'styles/products.css';
require_once 'includes/header.php';

$category = $_GET['category'] ?? null;
$search = $_GET['search'] ?? null;
?>
<section class="section">
    <div class="container">
        <h1 class="section-title">Our Products</h1>
        
        <div class="products-grid">
            <?php
            require_once 'includes/db_connect.php';
            
            $category = $_GET['category'] ?? '';
            $sql = "SELECT * FROM products";
            $params = [];
            
            if ($category) {
                $sql .= " WHERE category = ?";
                $params[] = ucfirst($category);
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            
            while ($product = $stmt->fetch()):
            ?>
            <div class="product-card" data-id="<?= htmlspecialchars($product['id']) ?>">
                <div class="product-img">
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-info">
                    <div class="product-category"><?= htmlspecialchars($product['category']) ?></div>
                    <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                    <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                    <div class="product-actions">
                        <form class="add-to-cart-form" method="post" action="add-to-cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($product['image_url']) ?>">
                            <button type="submit" class="add-to-cart">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                        <button class="wishlist-btn"><i class="fas fa-heart"></i></button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<script>
// Add AJAX functionality for add to cart
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('add-to-cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count in header
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                        cartCount.style.display = 'flex';
                    }
                    
                    // Show success message
                    const button = this.querySelector('.add-to-cart');
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-check"></i> Added!';
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                    }, 2000);
                }
            });
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>