document.addEventListener('DOMContentLoaded', function() {
    // Premium announcement messages with emoji alternatives
    const announcements = [
        { 
            text: "FLASH SALE: 24 HOURS ONLY!", 
            icon: "fa-bolt",
            colors: ["#ff4d4d", "#ff9500"]
        },
        { 
            text: "FREE WORLDWIDE SHIPPING", 
            icon: "fa-globe",
            colors: ["#00b894", "#0984e3"]
        },
        { 
            text: "NEW COLLECTION LAUNCHED", 
            icon: "fa-fire",
            colors: ["#ff7675", "#e84393"]
        },
        { 
            text: "EXTENDED RETURNS: 60 DAYS", 
            icon: "fa-undo",
            colors: ["#00cec9", "#0984e3"]
        }
    ];

    // Premium welcome messages
    const welcomeMessages = [
        { text: "EXCLUSIVE OFFER: 20% OFF FOR NEW CUSTOMERS", icon: "fa-gem" },
        { text: "JOIN OUR VIP PROGRAM FOR SPECIAL BENEFITS", icon: "fa-crown" },
        { text: "FREE GIFT WITH PURCHASES OVER $100", icon: "fa-gift" }
    ];

    // Set up premium announcement bar
    const announcementBar = document.querySelector('.announcement-bar');
    const announcementContent = document.querySelector('.announcement-content');
    
    if (announcementContent) {
        // Create scrolling content
        announcements.forEach((msg, index) => {
            const messageEl = document.createElement('div');
            messageEl.className = 'announcement-message';
            messageEl.style.background = `linear-gradient(90deg, ${msg.colors[0]}, ${msg.colors[1]})`;
            messageEl.innerHTML = `
                <i class="fas ${msg.icon}"></i>
                <span>${msg.text}</span>
            `;
            
            // Clone for seamless looping
            const clone = messageEl.cloneNode(true);
            announcementContent.appendChild(messageEl);
            announcementContent.appendChild(clone);
        });

        // Dynamic speed adjustment
        const speed = 18; // Base speed in seconds
        announcementContent.style.animationDuration = `${speed}s`;
        
        // Color shift effect
        let currentIndex = 0;
        setInterval(() => {
            currentIndex = (currentIndex + 1) % announcements.length;
            const colors = announcements[currentIndex].colors;
            announcementBar.style.background = `linear-gradient(90deg, ${colors[0]}, ${colors[1]})`;
        }, 4000);
    }

    // Premium welcome message for guests
    const welcomeContainer = document.querySelector('.header-top:not(.logged-in)');
    if (welcomeContainer) {
        const welcomeMessage = welcomeContainer.querySelector('.welcome-message');
        let currentMessage = 0;
        
        function updateWelcomeMessage() {
            const msg = welcomeMessages[currentMessage];
            welcomeMessage.innerHTML = `
                <i class="fas ${msg.icon}"></i>
                <span class="welcome-text">${msg.text}</span>
            `;
            
            // Adjust animation if needed
            if (welcomeMessage.scrollWidth > welcomeContainer.offsetWidth) {
                welcomeMessage.style.animation = 'scrollWelcome 16s linear infinite';
            } else {
                welcomeMessage.style.animation = 'none';
                welcomeMessage.style.left = '0';
                welcomeMessage.style.transform = 'none';
            }
            
            currentMessage = (currentMessage + 1) % welcomeMessages.length;
        }
        
        // Initial update
        updateWelcomeMessage();
        
        // Rotate every 6 seconds
        setInterval(updateWelcomeMessage, 6000);
    }

    // Rest of your existing JS...
    
});
document.querySelectorAll('.quick-add').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${productId}&quantity=1`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count in header
                    updateCartCount(data.cart_count);
                    
                    // Show success message
                    showToast('Item added to cart!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding to cart.');
            });
        });
    });

    function updateCartCount(count) {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            cartCount.textContent = count;
            cartCount.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
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