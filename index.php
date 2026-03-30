<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Home</title>
    
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
    <header class="site-header" id="header">
        <div class="container">
            <div class="header-inner">
                <a href="#" class="logo">Maison <span>Dorée</span></a>
                
                <nav class="nav-main">
                    <a href="collections.php">Collections</a>
                    <a href="shop.php">Shop</a>
                    <a href="story.php">Our Story</a>
                    <a href="craftsmanship.php">Craftsmanship</a>
                    <a href="contact.php">Visit Us</a>
                    <a href="contact.php" class="nav-cta">Book Appointment</a>
                </nav>
                
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    
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
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <p class="text-label hero-tagline">Artisan Gold Jewelry Since 1987</p>
            <h1 class="heading-display hero-title">
                Where Gold<br>Becomes <em>Art</em>
            </h1>
            <p class="text-body hero-description">
                Each piece in our collection is handcrafted by master artisans, 
                transforming the finest gold into wearable works of art that 
                tell your unique story.
            </p>
            <div class="hero-actions">
                <a href="collections.php" class="btn-primary">Explore Collections</a>
                <a href="story.php" class="btn-text">Our Heritage</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-slide active" data-title="Serpentine Collection" data-price="From $2,400">
                <img src="images/maison-hero-01.jpg" 
                     alt="Serpentine gold jewelry collection">
            </div>
            <div class="hero-slide" data-title="Aurora Pendant" data-price="From $4,850">
                <img src="images/maison-hero-02.jpg" 
                     alt="Aurora gold pendant necklace">
            </div>
            <div class="hero-slide" data-title="Heritage Rings" data-price="From $3,200">
                <img src="images/maison-hero-03.jpg" 
                     alt="Heritage gold ring collection">
            </div>
            <div class="hero-image-overlay">
                <p class="overlay-title" id="heroTitle">Serpentine Collection</p>
                <p class="overlay-price" id="heroPrice">From $2,400</p>
            </div>
        </div>
    </section>
    
    <!-- Featured Piece -->
    <section class="featured-piece">
        <div class="container">
            <div class="featured-grid">
                <div class="featured-image-wrapper">
                    <div class="featured-image">
                        <img src="images/maison-hero-02.jpg" 
                             alt="Handcrafted gold necklace">
                    </div>
                    <div class="featured-badge">New Arrival</div>
                </div>
                <div class="featured-content">
                    <p class="text-label featured-label">Featured Piece</p>
                    <h2 class="heading-display featured-title">
                        Aurora Pendant
                    </h2>
                    <p class="text-body featured-description">
                        Inspired by the ethereal dance of northern lights, 
                        the Aurora Pendant captures the fluid movement of light 
                        through hand-hammered 22-karat gold. Each surface catches 
                        and reflects light differently, creating a mesmerizing 
                        display of golden hues.
                    </p>
                    <div class="featured-details">
                        <div class="detail-row">
                            <span class="detail-label">Material</span>
                            <span class="detail-value">22K Yellow Gold</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Weight</span>
                            <span class="detail-value">18.5 grams</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Chain Length</span>
                            <span class="detail-value">18 inches (adjustable)</span>
                        </div>
                    </div>
                    <p class="featured-price">$4,850</p>
                    <a href="contact.php" class="btn-primary">Inquire About This Piece</a>
                </div>
            </div>
        </div>
    </section>
    










    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
