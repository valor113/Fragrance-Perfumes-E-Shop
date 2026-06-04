<?php require __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Doree - Craftsmanship</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="craftsmanship" id="craftsmanship">
        <div class="container">
            <div class="craft-grid">
                <div class="craft-content">
                    <p class="text-label">The Art of Selection</p>
                    <h2 class="heading-display craft-title">Curated With Care, Presented With Elegance</h2>
                    <p class="text-body craft-text">
                        Each fragrance is selected for character, quality, and presentation. The PHP project keeps the original visual
                        style while making the catalogue editable through a database-backed administration area.
                    </p>
                    <ul class="craft-list text-body">
                        <li>Database products displayed on the shop page</li>
                        <li>Secure admin login with hashed password</li>
                        <li>PDO prepared statements for all database writes</li>
                        <li>Simple OOP classes that are easy to explain</li>
                    </ul>
                    <a href="contact.php" class="btn-primary">Book a Consultation</a>
                </div>
                <div class="craft-image-wrapper">
                    <div class="craft-image">
                        <img src="images/maison-doree-07.jpg" alt="Luxury fragrance display">
                    </div>
                    <div class="craft-stats">
                        <div class="stat-item">
                            <p class="stat-number">PHP</p>
                            <p class="stat-label">Pure Backend</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">PDO</p>
                            <p class="stat-label">Database Access</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">CRUD</p>
                            <p class="stat-label">Admin Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
