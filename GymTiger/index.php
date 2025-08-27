<?php
require_once __DIR__.'/includes/init.php';
$pageTitle = 'Gym Tiger | High-Performance Athletic Apparel';
require_once 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium performance apparel engineered for serious athletes. Gym Tiger combines cutting-edge fabric technology with uncompromising design.">
    <meta name="keywords" content="performance apparel, athletic wear, gym clothing, training gear, sportswear">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Gym Tiger | High-Performance Athletic Apparel">
    <meta property="og:description" content="Premium performance apparel engineered for serious athletes.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.gymtiger.com">
    <meta property="og:image" content="https://www.gymtiger.com/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicon-16x16.png" sizes="16x16">
    
    <!-- CSS -->
    <style>
        /* Reset and Base Styles */
        :root {
            --primary: #2a2a72;
            --primary-light: #3a3a8a;
            --secondary: #ff6b6b;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --white: #ffffff;
            --black: #212529;
            --transition: all 0.3s ease;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: var(--black);
            background-color: var(--white);
            overflow-x: hidden;
        }
        
        .is-loading {
            overflow: hidden;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Typography */
        h1, h2, h3, h4 {
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }
        
        h1 { font-size: 2.5rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.75rem; }
        h4 { font-size: 1.5rem; }
        
        @media (min-width: 768px) {
            h1 { font-size: 3.5rem; }
            h2 { font-size: 2.5rem; }
            h3 { font-size: 2rem; }
        }
        
        p {
            margin-bottom: 1rem;
        }
        
        a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        a:hover {
            color: var(--primary-light);
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-highlight {
            color: var(--secondary);
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        
        .btn-outline {
            background-color: transparent;
            border-color: var(--white);
            color: var(--white);
        }
        
        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        
        .btn-light {
            background-color: var(--white);
            color: var(--primary);
        }
        
        /* Layout */
        .section-padding {
            padding: 5rem 0;
        }
        
        .bg-light {
            background-color: var(--light-gray);
        }
        
        .bg-dark {
            background-color: var(--dark);
            color: var(--white);
        }
        
        /* Announcement Bar */
        .announcement-bar {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.5rem 0;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Search Bar */
        .main-search-container {
            padding: 1.5rem 0;
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: relative;
            z-index: 100;
        }
        
        .search-wrapper {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .main-search-form input[type="search"] {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid var(--light-gray);
            border-radius: 4px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .main-search-form input[type="search"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 42, 114, 0.2);
        }
        
        .search-submit {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray);
        }
        
        /* Hero Section */
        .hero-banner {
            position: relative;
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: var(--white);
            overflow: hidden;
        }
        
        .hero-media {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .hero-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.2;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .hero-title {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .hero-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .hero-scroll-down {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
            40% { transform: translateY(-20px) translateX(-50%); }
            60% { transform: translateY(-10px) translateX(-50%); }
        }
        
        /* Technology Section */
        .technology-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .tech-card {
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .tech-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .tech-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(42, 42, 114, 0.1);
            border-radius: 50%;
            color: var(--primary);
        }
        
        .tech-icon svg {
            width: 40px;
            height: 40px;
        }
        
        /* Collections Section */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }
        
        .view-all {
            font-weight: 600;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
        }
        
        .view-all::after {
            content: '→';
            margin-left: 0.5rem;
            transition: var(--transition);
        }
        
        .view-all:hover::after {
            transform: translateX(3px);
        }
        
        .collection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .collection-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .collection-image {
            height: 300px;
            overflow: hidden;
        }
        
        .collection-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .collection-card:hover .collection-image img {
            transform: scale(1.05);
        }
        
        .collection-info {
            padding: 1.5rem;
            background: var(--white);
        }
        
        .collection-info h3 {
            color: var(--primary);
        }
        
        .shop-now {
            display: inline-block;
            margin-top: 0.5rem;
            font-weight: 600;
            color: var(--secondary);
        }
        
        /* Testimonials */
        .testimonials-slider {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            padding: 1rem 0;
            scroll-snap-type: x mandatory;
            margin-top: 3rem;
        }
        
        .testimonial {
            min-width: 300px;
            scroll-snap-align: start;
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }
        
        .testimonial-content {
            font-style: italic;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .testimonial-content::before {
            content: '"';
            font-size: 4rem;
            position: absolute;
            top: -1rem;
            left: -1rem;
            color: var(--light-gray);
            z-index: -1;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }
        
        /* Newsletter Section */
        .newsletter-section {
            padding: 4rem 0;
            background-color: var(--dark);
            color: var(--white);
        }
        
        .newsletter-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .newsletter-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            align-items: center;
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .newsletter-content {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
            }
        }
        
        .newsletter-info {
            flex: 1;
            min-width: 300px;
        }
        
        .newsletter-title {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: var(--white);
        }
        
        .newsletter-text {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 400px;
        }
        
        .newsletter-form {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
        }
        
        .form-group {
            display: flex;
            margin-bottom: 0.5rem;
        }
        
        .newsletter-input {
            flex: 1;
            padding: 0.9rem 1.2rem;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 1rem;
            min-width: 200px;
        }
        
        .newsletter-input:focus {
            outline: 2px solid var(--secondary);
            outline-offset: -2px;
        }
        
        .newsletter-submit {
            border-radius: 0 4px 4px 0;
            padding: 0.9rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .newsletter-submit:hover {
            background-color: var(--light-gray);
            transform: none;
        }
        
        .form-note {
            font-size: 0.75rem;
            opacity: 0.7;
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .form-note {
                text-align: left;
            }
        }
        
        .privacy-link {
            color: var(--secondary);
            text-decoration: underline;
        }
        
        .privacy-link:hover {
            color: var(--white);
        }

        /* Loading Overlay */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loader-logo {
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .section-padding {
                padding: 3rem 0;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-cta {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body class="is-loading">
    <!-- Loading Overlay -->
    <div class="page-loader">
        <div class="loader-logo">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0Z" fill="#2a2a72"/>
                <path d="M24 36C30.6274 36 36 30.6274 36 24C36 17.3726 30.6274 12 24 12C17.3726 12 12 17.3726 12 24C12 30.6274 17.3726 36 24 36Z" fill="#ff6b6b"/>
                <path d="M28 20C28 22.2091 26.2091 24 24 24C21.7909 24 20 22.2091 20 20C20 17.7909 21.7909 16 24 16C26.2091 16 28 17.7909 28 20Z" fill="#2a2a72"/>
            </svg>
        </div>
    </div>

    <div class="page-wrapper">

        <!-- Main Search Bar -->
        <div class="main-search-container">
            <div class="container">
                <form class="main-search-form text-center" action="products.php" method="GET" role="search">
                    <div class="search-wrapper">
                        <input type="search" name="search" placeholder="Search performance apparel..." aria-label="Search products" autocomplete="off">
                        <button type="submit" class="search-submit" aria-label="Submit search">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hero Banner -->
        <section class="hero-banner">
            <div class="hero-media">
                <!-- Placeholder for video background -->
                <div style="background-color: var(--primary); width: 100%; height: 100%;"></div>
            </div>
            
            <div class="container">
                <div class="hero-content text-center">
                    <h1 class="hero-title">Engineered for <span class="text-highlight">Peak Performance</span></h1>
                    <p class="hero-subtitle">Precision-crafted athletic apparel that matches your intensity</p>
                    <div class="hero-cta">
                        <a href="products.php" class="btn btn-primary">Shop Collection</a>
                        <a href="#technology" class="btn btn-outline">Our Technology</a>
                    </div>
                </div>
            </div>
            
            <a href="#main-content" class="hero-scroll-down" aria-label="Scroll down">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M12 5v14M19 12l-7 7-7-7"/>
                </svg>
            </a>
        </section>

        <!-- Main Content -->
        <main id="main-content">
            <!-- Technology Section -->
            <section class="technology-section section-padding" id="technology">
                <div class="container">
                    <div class="section-header text-center">
                        <h2 class="section-title">Innovation Woven Into Every Fiber</h2>
                    </div>
                    
                    <div class="technology-grid">
                        <div class="tech-card">
                            <div class="tech-icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                            </div>
                            <h3>Advanced Moisture Control</h3>
                            <p>Quad-directional wicking fabric moves sweat away 40% faster than standard materials</p>
                        </div>
                        
                        <div class="tech-card">
                            <div class="tech-icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>
                            </div>
                            <h3>Antimicrobial Protection</h3>
                            <p>Silver-ion treated fibers prevent odor-causing bacteria for long-lasting freshness</p>
                        </div>
                        
                        <div class="tech-card">
                            <div class="tech-icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="12" y1="3" x2="12" y2="21"></line>
                                    <line x1="21" y1="12" x2="3" y2="12"></line>
                                </svg>
                            </div>
                            <h3>4D Strategic Stretch</h3>
                            <p>Unrestricted mobility with targeted compression where you need it most</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Newsletter -->
            <section class="newsletter-section bg-dark">
                <div class="container">
                    <div class="newsletter-wrapper">
                        <div class="newsletter-content">
                            <div class="newsletter-info">
                                <h3 class="newsletter-title">Join the Pride</h3>
                                <p class="newsletter-text">Subscribe for exclusive offers, training content, and early access to new collections.</p>
                            </div>
                            <form class="newsletter-form" action="/subscribe" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Your email address" required class="newsletter-input">
                                    <button type="submit" class="btn btn-light newsletter-submit">Subscribe</button>
                                </div>
                                <p class="form-note">By subscribing, you agree to our <a href="/privacy" class="privacy-link">Privacy Policy</a>.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php require_once 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script>
        // Basic initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Remove loading class
            setTimeout(function() {
                document.body.classList.remove('is-loading');
                document.querySelector('.page-loader').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.page-loader').style.display = 'none';
                }, 500);
            }, 1000);
            
            // Simple scroll to anchor
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>