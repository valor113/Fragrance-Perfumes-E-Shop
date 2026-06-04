<?php require __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Doree - Our Story</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="story" id="story">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <p class="text-label story-label">Our Heritage</p>
                    <h2 class="heading-display story-title">Three Generations of Fragrance Curation</h2>
                    <p class="text-body story-text">
                        Maison Doree began as a small family boutique dedicated to elegant perfumes and personal consultations.
                        The project keeps that luxury visual identity while using PHP and MySQL for the product catalogue.
                    </p>
                    <p class="text-body story-text">
                        Today, the website presents selected fragrances, database-driven shop content, and a protected admin area
                        where products can be created, edited, and removed.
                    </p>
                    <div class="story-signature">
                        <p class="signature-name">Maison Doree</p>
                        <p class="signature-title">Luxury Fragrance Boutique</p>
                    </div>
                </div>
                <div class="story-images">
                    <div class="story-image">
                        <img src="images/maison-doree-05.jpg" alt="Fragrance boutique detail">
                    </div>
                    <div class="story-image">
                        <img src="images/maison-doree-06.jpg" alt="Perfume presentation detail">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
