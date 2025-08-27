// scripts/products.js
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    document.querySelectorAll('.add-to-cart-btn, .quick-add-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            addToCart(productId);
        });
    });
    
    function addToCart(productId) {
        fetch('includes/update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=1&action=add`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update cart count in header
                document.querySelectorAll('.cart-count').forEach(el => {
                    el.textContent = data.cart_count;
                    el.style.display = 'flex';
                });
                
                // Show success message
                showToast('Product added to cart!');
            } else {
                alert('Error adding to cart: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});