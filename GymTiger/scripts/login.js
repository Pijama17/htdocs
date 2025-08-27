document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    
    form.addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        if (!email || !password) {
            e.preventDefault();
            alert('Please fill in all fields');
            return false;
        }
        
        return true;
    });
});