<?php 
require_once __DIR__.'/includes/db_connect.php';
require_once __DIR__.'/includes/header.php';

$message = '';
$messageClass = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate required fields
        $required = ['name', 'email', 'subject', 'message'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Please fill in all required fields");
            }
        }

        // Sanitize and validate input 
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $subject = htmlspecialchars(trim($_POST['subject']));
        $message = htmlspecialchars(trim($_POST['message']));

        if (!$email) {
            throw new Exception("Please enter a valid email address");
        }

        // Save to database
        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message, created_at) 
                              VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $message]);

        // Success message
        $message = "Thank you! Your message has been sent successfully. We'll respond within 24 hours.";
        $messageClass = "success";
        
        // Clear form on success
        $_POST = [];
        
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
        $messageClass = "error";
    }
}
?>

<section class="contact-section">
    <div class="container">
        <h1 class="section-title">Contact Gym Tiger</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-<?= $messageClass ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <div class="contact-grid">
            <!-- Contact Information Column -->
            <div class="contact-info">
                <div class="info-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Our Location</h3>
                    <p>123 Fitness Street<br>New York, NY 10001</p>
                    
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215373510518!2d-73.9878449241646!3d40.74844097138988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ0JzU0LjQiTiA3M8KwNTknMDkuOSJX!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" 
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-clock"></i> Opening Hours</h3>
                    <ul class="hours-list">
                        <li><span>Monday - Friday:</span> 5:00 AM - 11:00 PM</li>
                        <li><span>Saturday:</span> 7:00 AM - 9:00 PM</li>
                        <li><span>Sunday:</span> 8:00 AM - 8:00 PM</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-phone-alt"></i> Contact Details</h3>
                    <ul class="contact-details">
                        <li><i class="fas fa-phone"></i> (212) 555-7890</li>
                        <li><i class="fas fa-envelope"></i> info@gymtiger.com</li>
                        <li><i class="fas fa-globe"></i> www.gymtiger.com</li>
                    </ul>
                    
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form Column -->
            <div class="contact-form-container">
                <h2>Send Us a Message</h2>
                <p>Have questions about memberships, personal training, or our facilities? Fill out the form below and we'll get back to you promptly.</p>
                
                <form method="POST" class="gym-contact-form">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" 
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="Membership Inquiry" <?= (isset($_POST['subject']) && $_POST['subject'] == 'Membership Inquiry') ? 'selected' : '' ?>>Membership Inquiry</option>
                            <option value="Personal Training" <?= (isset($_POST['subject']) && $_POST['subject'] == 'Personal Training') ? 'selected' : '' ?>>Personal Training</option>
                            <option value="Group Classes" <?= (isset($_POST['subject']) && $_POST['subject'] == 'Group Classes') ? 'selected' : '' ?>>Group Classes</option>
                            <option value="General Question" <?= (isset($_POST['subject']) && $_POST['subject'] == 'General Question') ? 'selected' : '' ?>>General Question</option>
                            <option value="Other" <?= (isset($_POST['subject']) && $_POST['subject'] == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message *</label>
                        <textarea id="message" name="message" rows="5" required><?= 
                            htmlspecialchars($_POST['message'] ?? '') 
                        ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__.'/includes/footer.php'; ?>