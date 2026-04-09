<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Collections</title>
    
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
    
    <!-- Collections -->
    <section class="collections" id="collections">
        <div class="container">
            <div class="section-header">
                <div class="section-header-left">
                    <h2 class="heading-display section-title">Our Collections</h2>
                    <p class="text-body section-subtitle">
                        Discover pieces crafted for every chapter of your story
                    </p>
                </div>
                <a href="#" class="btn-text">View All Collections</a>
            </div>
            
            <div class="collections-grid">
                <div class="collection-item">
                    <div class="collection-image">
                        <img src="images/maison-hero-03.jpg" 
                             alt="Bridal jewelry collection">
                    </div>
                    <div class="collection-overlay">
                        <h3 class="collection-name">Bridal</h3>
                        <p class="collection-count">24 pieces</p>
                    </div>
                </div>
                
                <div class="collection-item">
                    <div class="collection-image">
                        <img src="images/maison-doree-01.jpg" 
                             alt="Everyday gold jewelry">
                    </div>
                    <div class="collection-overlay">
                        <h3 class="collection-name">Everyday Elegance</h3>
                        <p class="collection-count">36 pieces</p>
                    </div>
                </div>
                
                <div class="collection-item">
                    <div class="collection-image">
                        <img src="images/maison-doree-02.jpg" 
                             alt="Statement gold pieces">
                    </div>
                    <div class="collection-overlay">
                        <h3 class="collection-name">Statement</h3>
                        <p class="collection-count">18 pieces</p>
                    </div>
                </div>
                
                <div class="collection-item">
                    <div class="collection-image">
                        <img src="images/maison-doree-03.jpg" 
                             alt="Heritage collection">
                    </div>
                    <div class="collection-overlay">
                        <h3 class="collection-name">Heritage</h3>
                        <p class="collection-count">12 pieces</p>
                    </div>
                </div>
                
                <div class="collection-item">
                    <div class="collection-image">
                        <img src="images/maison-doree-04.jpg" 
                             alt="Men's gold collection">
                    </div>
                    <div class="collection-overlay">
                        <h3 class="collection-name">Men's Collection</h3>
                        <p class="collection-count">15 pieces</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
