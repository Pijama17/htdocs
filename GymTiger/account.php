<?php
require_once __DIR__.'/includes/db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Gym Tiger</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/account.css">
</head> 
<body>
    <?php require_once 'includes/header.php'; ?>
    
    <div class="account-container">
        <div class="account-sidebar">
            <div class="profile-summary">
                <div class="profile-pic">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <h3><?= htmlspecialchars($user['name']) ?></h3>
                <p><?= htmlspecialchars($user['email']) ?></p>
            </div>
            
            <nav class="account-nav">
                <a href="account.php" class="active"><i class="fas fa-user"></i> Profile</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Bookings</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </div>
        
        <div class="account-content">
            <h2>My Profile</h2>
            
            <div class="profile-section">
                <h3>Personal Information</h3>
                <div class="profile-info">
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value"><?= htmlspecialchars($user['name']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Member Since:</span>
                        <span class="info-value"><?= date('F j, Y', strtotime($user['created_at'])) ?></span>
                    </div>
                </div>
            </div>
            
            <div class="profile-section">
                <h3>Account Actions</h3>
                <div class="action-buttons">
                    <a href="edit-profile.php" class="btn btn-edit">Edit Profile</a>
                    <a href="change-password.php" class="btn btn-change">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once 'includes/footer.php'; ?>
    
    <script src="scripts/account.js"></script>
</body>
</html>