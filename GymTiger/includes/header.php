<?php
require_once __DIR__.'/init.php';
$isLoggedIn = isLoggedIn();
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
$cartCount = $_SESSION['cart_count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Gym Tiger | Premium Fitness Apparel' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/gymtiger/styles/header.css">
    <link rel="stylesheet" href="/gymtiger/styles/main.css">
    <?= isset($customCSS) ? '<link rel="stylesheet" href="/gymtiger/'.$customCSS.'">' : '' ?>
    <?php if (basename($_SERVER['PHP_SELF']) == 'cart.php'): ?>
        <link rel="stylesheet" href="/gymtiger/styles/cart.css">
    <?php endif; ?>
</head>
<body>
    <!-- Announcement Bar --> 
    <div class="announcement-bar">
        <div class="container">
            <p>🔥 Free shipping on all orders over $50! Use code: TIGER10 for 10% off</p>
        </div>
    </div>

    <!-- Header Top Bar -->
    <div class="header-top <?= $isLoggedIn ? 'logged-in' : '' ?>">
        <div class="header-links">
            <?php if ($isLoggedIn): ?>
                <div class="welcome-message">
                    <i class="fas fa-user-check"></i>
                    <span class="welcome-text">WELCOME BACK, <?= strtoupper(htmlspecialchars($userName)) ?></span>
                </div>
            <?php else: ?>
                <div class="welcome-message">
                    <i class="fas fa-star"></i>
                    <span class="welcome-text">WELCOME TO GYM TIGER PREMIUM</span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Header Section -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">
                    <i class="fas fa-dumbbell"></i>
                    <span>GYM TIGER</span>
                </a>
                
                <nav class="main-nav">
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">Shop</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
                
                <div class="header-actions">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                    <a href="cart.php" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" style="display: <?= $cartCount > 0 ? 'flex' : 'none' ?>">
                            <?= $cartCount ?>
                        </span>
                    </a>
                    
                    <?php if ($isLoggedIn): ?>
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <div class="user-avatar">
                                    <?= strtoupper(substr($userName, 0, 1)) ?>
                                </div>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <h4><?= htmlspecialchars($userName) ?></h4>
                                    <p><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></p>
                                </div>
                                <a href="account.php"><i class="fas fa-user"></i> Account</a>
                                <a href="orders.php"><i class="fas fa-shopping-bag"></i> Orders</a>
                                <a href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a>
                                <div class="dropdown-divider"></div>
                                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="auth-buttons">
                            <a href="login.php" class="login-btn">Login</a>
                            <a href="register.php" class="register-btn">Register</a>
                        </div>
                    <?php endif; ?>
                    
                    <button class="mobile-toggle"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </header>
    
    <main>