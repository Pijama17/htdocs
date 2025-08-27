document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const accountNav = document.querySelector('.account-nav');
    
    if (mobileMenuToggle && accountNav) {
        mobileMenuToggle.addEventListener('click', function() {
            accountNav.style.display = accountNav.style.display === 'block' ? 'none' : 'block';
        });
    }
    
    // Add active class to clicked nav items
    const navLinks = document.querySelectorAll('.account-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Confirmation for logout
    const logoutLinks = document.querySelectorAll('a[href="logout.php"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to logout?')) {
                e.preventDefault();
            }
        });
    });
});