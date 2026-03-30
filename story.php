<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Our Story</title>
    
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
    
    <!-- Our Story -->
    <section class="story" id="story">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <p class="text-label story-label">Our Heritage</p>
                    <h2 class="heading-display story-title">
                        Three Generations of Golden Mastery
                    </h2>
                    <p class="text-body story-text">
                        Founded in 1987 by master goldsmith Henri Beaumont, 
                        Maison Dorée has remained a family atelier dedicated to 
                        the art of fine gold jewelry. What began in a small 
                        workshop in the heart of the jewelry district has 
                        blossomed into a celebrated house known for impeccable 
                        craftsmanship.
                    </p>
                    <p class="text-body story-text">
                        Today, our third-generation artisans continue the 
                        tradition, blending time-honored techniques with 
                        contemporary design sensibilities. Every piece that 
                        leaves our workshop carries the weight of this legacy.
                    </p>
                    <div class="story-signature">
                        <p class="signature-name">Isabelle Beaumont</p>
                        <p class="signature-title">Creative Director</p>
                    </div>
                </div>
                <div class="story-images">
                    <div class="story-image">
                        <img src="images/maison-doree-05.jpg" 
                             alt="Goldsmith at work">
                    </div>
                    <div class="story-image">
                        <img src="images/maison-doree-06.jpg" 
                             alt="Jewelry crafting detail">
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
