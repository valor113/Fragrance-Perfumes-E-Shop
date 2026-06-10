<?php require __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fragrance Guide - Find Your Signature Scent | Maison Doree</title>
    <meta name="description" content="Learn how to choose perfume by scent family, mood, occasion, concentration, longevity, and personal style.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="fragrance-guide" id="fragrance-guide">
        <div class="container">
            <div class="craft-grid">
                <div class="craft-content">
                    <p class="text-label">Scent Discovery</p>
                    <h1 class="heading-display craft-title">A Fragrance Guide for Finding What Feels Like You</h1>
                    <p class="text-body craft-text">
                        Maison Doree curates perfumes from established fragrance houses. We help you compare notes, character,
                        concentration, and wear so you can choose with confidence without pretending that one scent suits everyone.
                    </p>
                    <ul class="craft-list text-body">
                        <li>Start with a scent family that already feels familiar</li>
                        <li>Match the fragrance mood to your setting and personal style</li>
                        <li>Compare concentration and expected wear, then test on skin</li>
                        <li>Give the opening, heart, and base notes time to develop</li>
                    </ul>
                    <a href="collections.php" class="btn-primary">Explore Scent Families</a>
                </div>
                <div class="craft-image-wrapper">
                    <div class="craft-image">
                        <img src="images/Roja_perfumes.jpg" alt="Curated luxury perfume bottles for scent discovery">
                    </div>
                    <div class="craft-stats fragrance-levels" aria-label="Common perfume concentrations">
                        <div class="stat-item">
                            <p class="stat-number">EDT</p>
                            <p class="stat-label">Lighter Wear</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">EDP</p>
                            <p class="stat-label">Richer Wear</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number">Parfum</p>
                            <p class="stat-label">Most Concentrated</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="guide-grid">
                <article class="guide-card">
                    <p class="text-label">01</p>
                    <h2>Scent Family</h2>
                    <p>Floral scents can feel soft or radiant; woody scents often feel grounded; fresh scents lean crisp; amber and oriental styles bring warmth; gourmand perfumes feature edible impressions such as vanilla, cocoa, or caramel.</p>
                </article>
                <article class="guide-card">
                    <p class="text-label">02</p>
                    <h2>Mood and Style</h2>
                    <p>Choose a fragrance that supports how you want to feel: clean and relaxed, polished and confident, warm and comforting, or bold and expressive. Your taste matters more than a gender label.</p>
                </article>
                <article class="guide-card">
                    <p class="text-label">03</p>
                    <h2>Occasion</h2>
                    <p>Subtle fresh or soft woody scents are easy for everyday wear. Date nights may suit deeper amber, spicy, or gourmand profiles. Gift sets and discovery choices work well when you are still learning someone's preferences.</p>
                </article>
                <article class="guide-card">
                    <p class="text-label">04</p>
                    <h2>Longevity</h2>
                    <p>Wear time varies with formula, skin, climate, and application. Concentration is useful guidance, not a guarantee. Test a fragrance for several hours to understand its projection and dry-down.</p>
                </article>
                <article class="guide-card">
                    <p class="text-label">05</p>
                    <h2>Concentration</h2>
                    <p>Eau de toilette is often lighter, eau de parfum is usually fuller, and parfum is generally the most concentrated. The best choice depends on the composition and how strongly you prefer to wear it.</p>
                </article>
                <article class="guide-card">
                    <p class="text-label">06</p>
                    <h2>Try It Your Way</h2>
                    <p>Blotters help with first impressions, but skin reveals how a perfume develops for you. Sample one or two at a time, avoid rubbing the wrists, and revisit the scent after the top notes settle.</p>
                </article>
            </div>

            <div class="guide-cta">
                <div>
                    <p class="text-label">Personal Guidance</p>
                    <h2 class="heading-display">Need help narrowing the choices?</h2>
                </div>
                <a href="contact.php" class="btn-primary">Book a Scent Consultation</a>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
