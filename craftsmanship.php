<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Craftsmanship</title>
    
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
                <a href="index.php" class="logo">Maison <span>Dorée</span></a>
                
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
    
    <!-- Craftsmanship -->
    <section class="craftsmanship" id="craftsmanship">
        <div class="container">
            <div class="craft-grid">
                <div class="craft-content">
                    <p class="text-label">The Art of Creation</p>
                    <h2 class="heading-display craft-title">
                        Crafted by Hand, Treasured Forever
                    </h2>
                    <p class="text-body craft-text">
                        Each Maison Dorée piece undergoes a meticulous journey 
                        from concept to completion. Our artisans employ 
                        traditional goldsmithing techniques passed down through 
                        generations, ensuring every curve, texture, and finish 
                        meets our exacting standards.
                    </p>
                    <ul class="craft-list text-body">
                        <li>Hand-selected materials from ethical sources</li>
                        <li>Traditional lost-wax casting and hand-forging</li>
                        <li>Multiple quality inspections at every stage</li>
                        <li>Personalized finishing and custom sizing</li>
                    </ul>
                    <a href="contact.php" class="btn-primary">Commission a Custom Piece</a>
                </div>
                <div class="craft-image-wrapper">
                    <div class="craft-image">
                        <img src="images/maison-doree-07.jpg" 
                             alt="Jewelry craftsmanship workshop">
                    </div>
                    <div class="craft-stats">
                        <div class="stat-item">
                            <p class="stat-number">37</p>
                            <p class="stat-label">Years of Excellence</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">12</p>
                            <p class="stat-label">Master Artisans</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">8K+</p>
                            <p class="stat-label">Pieces Created</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
