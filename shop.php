<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Dorée — Shop</title>
    
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
    
    <!-- Shop Section -->
    <section class="shop">
        <div class="container">
            <div class="section-header">
                <div class="section-header-left">
                    <h2 class="heading-display section-title">Our Shop</h2>
                    <p class="text-body section-subtitle">
                        Discover exquisite pieces available for purchase
                    </p>
                </div>
                <div class="shop-filters">
                    <select class="filter-select">
                        <option>All Collections</option>
                        <option>Bridal</option>
                        <option>Everyday Elegance</option>
                        <option>Statement</option>
                        <option>Heritage</option>
                        <option>Men's Collection</option>
                    </select>
                </div>
            </div>
            
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-hero-02.jpg" 
                             alt="Aurora Pendant">
                        <div class="product-badge">New</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Aurora Pendant</h3>
                        <p class="product-description">Handcrafted 22K gold pendant with northern lights inspiration</p>
                        <p class="product-price">$4,850</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-hero-03.jpg" 
                             alt="Heritage Ring">
                        <div class="product-badge">Bestseller</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Heritage Ring</h3>
                        <p class="product-description">Classic gold band with intricate detailing</p>
                        <p class="product-price">$3,200</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-doree-01.jpg" 
                             alt="Elegance Earrings">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Elegance Earrings</h3>
                        <p class="product-description">Delicate gold earrings perfect for everyday wear</p>
                        <p class="product-price">$1,450</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-doree-02.jpg" 
                             alt="Statement Necklace">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Statement Necklace</h3>
                        <p class="product-description">Bold gold necklace for special occasions</p>
                        <p class="product-price">$5,600</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-doree-03.jpg" 
                             alt="Heritage Bracelet">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Heritage Bracelet</h3>
                        <p class="product-description">Timeless gold bracelet with family crest design</p>
                        <p class="product-price">$2,800</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/maison-doree-04.jpg" 
                             alt="Men's Cufflinks">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Men's Cufflinks</h3>
                        <p class="product-description">Elegant gold cufflinks for formal occasions</p>
                        <p class="product-price">$950</p>
                        <button class="btn-primary product-btn">Add to Cart</button>
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
