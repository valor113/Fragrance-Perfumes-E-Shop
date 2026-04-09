<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Contact</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <!--

TemplateMo 611 Maison Doree

https://templatemo.com/tm-611-maison-doree

-->
</head>
<body>
    <!-- Header -->
    <?php include 'partials/header.php'; ?>
    
    <!-- Mobile Navigation -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <nav class="mobile-nav" id="mobileNav">
        <button class="mobile-nav-close" id="mobileNavClose">×</button>
        <ul class="mobile-nav-links">
            <li><a href="collections.php">Collections</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="story.php">Our Story</a></li>
            <li><a href="craftsmanship.php">Craftsmanship</a></li>
            <li><a href="contact.php">Visit Us</a></li>
        </ul>
        <div class="mobile-nav-cta">
            <a href="contact.php" class="btn-primary">Book Appointment</a>
        </div>
    </nav>
    
    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="testimonials-header">
                <p class="text-label">Client Stories</p>
                <h2 class="heading-display testimonials-title">Treasured by Many</h2>
                <p class="text-body testimonials-subtitle">What our clients say about their Maison Dorée experience</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="testimonial-text">
                        The attention to detail is extraordinary. My wedding set from Maison Dorée isn't just jewelry — it's a work of art that I'll cherish forever.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <img src="images/avatar-01.jpg" alt="Catherine W.">
                        </div>
                        <div class="testimonial-info">
                            <p class="testimonial-name">Catherine W.</p>
                            <p class="testimonial-detail">Bridal Collection</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="testimonial-text">
                        Working with the design team to create a custom anniversary gift was seamless. They understood my vision and exceeded expectations.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <img src="images/avatar-02.jpg" alt="Michael T.">
                        </div>
                        <div class="testimonial-info">
                            <p class="testimonial-name">Michael T.</p>
                            <p class="testimonial-detail">Custom Design</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="testimonial-text">
                        Three generations of my family have now worn pieces from Maison Dorée. The quality is unmatched and each piece tells our story.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <img src="images/avatar-03.jpg" alt="Eleanor M.">
                        </div>
                        <div class="testimonial-info">
                            <p class="testimonial-name">Eleanor M.</p>
                            <p class="testimonial-detail">Heritage Collection</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-content">
                    <p class="text-label">Visit Our Atelier</p>
                    <h2 class="heading-display contact-title">
                        Experience Maison Dorée
                    </h2>
                    <p class="text-body contact-text">
                        We invite you to visit our atelier for a personal 
                        consultation. Discover our collections in an intimate 
                        setting and work with our designers to create something 
                        truly unique.
                    </p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <p class="contact-item-label">Address</p>
                            <p class="contact-item-value">
                                742 Fifth Avenue, Suite 1200<br>
                                New York, NY 10019
                            </p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-item-label">Hours</p>
                            <p class="contact-item-value">
                                Tuesday – Saturday, 10:00 AM to 06:00 PM<br>
                                Sunday – Monday, By Appointment
                            </p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-item-label">Contact</p>
                            <p class="contact-item-value">
                                <a href="tel:+12125551234">+1 (212) 555-1234</a><br>
                                <a href="mailto:hello@maisondoree.com">hello@maisondoree.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form-wrapper">
                    <h3 class="form-title">Request an Appointment</h3>
                    <form id="appointmentForm">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="message">Tell Us About Your Visit</label>
                            <textarea id="message" name="message" class="form-textarea" 
                                placeholder="Interested in a specific collection? Planning a custom piece?"></textarea>
                        </div>
                        <button type="submit" class="form-submit">Request Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
