<?php
require_once __DIR__.'/includes/init.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: account.php');
    exit;
}

$error = '';
$formData = [
    'name' => '',
    'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $formData['name'] = trim($_POST['name']);
    $formData['email'] = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($formData['name']) || empty($formData['email']) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters';
    } else {
        try {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$formData['email']]);
            
            if ($stmt->rowCount() > 0) {
                $error = 'Email already registered';
            } else {
                // Hash password and create user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                
                if ($stmt->execute([$formData['name'], $formData['email'], $hashed_password])) {
                    // Regenerate session ID for security
                    session_regenerate_id(true);
                    
                    // Set session variables
                    $_SESSION['user_id'] = $pdo->lastInsertId();
                    $_SESSION['user_name'] = $formData['name'];
                    $_SESSION['user_email'] = $formData['email'];
                    $_SESSION['last_login'] = time();
                    
                    header('Location: account.php');
                    exit;
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            $error = 'A system error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Gym Tiger</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    
    <section class="section">
        <div class="container">
            <div class="auth-container">
                <div class="auth-form">
                    <h2 class="section-title">Create Your Account</h2>
                    
                    <?php if ($error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form method="post">
                        <div class="form-group">
                            <label class="form-label" for="register-name">Full Name</label>
                            <input type="text" class="form-input" id="register-name" name="name" required 
                                   value="<?= htmlspecialchars($formData['name']) ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="register-email">Email Address</label>
                            <input type="email" class="form-input" id="register-email" name="email" required
                                   value="<?= htmlspecialchars($formData['email']) ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="register-password">Password</label>
                            <input type="password" class="form-input" id="register-password" name="password" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="register-confirm">Confirm Password</label>
                            <input type="password" class="form-input" id="register-confirm" name="confirm_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required> 
                                I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn">Create Account</button>
                        
                        <div class="auth-switch">
                            Already have an account? <a href="login.php">Login now</a>
                        </div>
                    </form>
                </div>
                
                <div class="auth-image">
                    <img src="https://images.unsplash.com/photo-1552196563-55cd4e45efb3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fitness Community">
                    <div class="image-overlay">
                        <h3>Join the Tiger Pack</h3>
                        <p>Create an account to enjoy exclusive benefits, faster checkout, and personalized recommendations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php require_once 'includes/footer.php'; ?>
    <script src="scripts/register.js"></script>
</body>
</html>