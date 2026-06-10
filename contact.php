<?php
require __DIR__ . '/bootstrap.php';

use App\Controllers\AppointmentController;
use App\Core\Database;
use App\Models\Testimonial;

$testimonials = [];
$formResult = [];
$dbError = null;

try {
    $testimonials = (new Testimonial(Database::getConnection()))->allActive();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $formResult = (new AppointmentController())->store($_POST);
    }
} catch (Throwable $exception) {
    $dbError = $exception->getMessage();
}

$old = $formResult['old'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Doree - Contact</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="testimonials">
        <div class="container">
            <div class="testimonials-header">
                <p class="text-label">Client Stories</p>
                <h2 class="heading-display testimonials-title">Scents They Love</h2>
                <p class="text-body testimonials-subtitle">What our clients say about their Maison Doree fragrance experience</p>
            </div>
            <div class="testimonials-grid">
                <?php foreach ($testimonials as $testimonial): ?>
                    <article class="testimonial-card">
                        <div class="testimonial-stars">
                            <?php for ($i = 0; $i < (int) $testimonial['rating']; $i++): ?>
                                <span>*</span>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text"><?= e($testimonial['quote']) ?></p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <?php if ($testimonial['avatar_path']): ?>
                                    <img src="<?= e($testimonial['avatar_path']) ?>" alt="<?= e($testimonial['avatar_alt']) ?>">
                                <?php else: ?>
                                    <span aria-hidden="true"><?= e(strtoupper(substr($testimonial['author_name'], 0, 1))) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="testimonial-info">
                                <p class="testimonial-name"><?= e($testimonial['author_name']) ?></p>
                                <p class="testimonial-detail"><?= e($testimonial['author_detail']) ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-content">
                    <p class="text-label">Visit Our Atelier</p>
                    <h2 class="heading-display contact-title">Experience Maison Doree</h2>
                    <p class="text-body contact-text">
                        Visit our boutique for a personal consultation and discover fragrances in an intimate setting.
                    </p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <p class="contact-item-label">Address</p>
                            <p class="contact-item-value">742 Fifth Avenue, Suite 1200<br>New York, NY 10019</p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-item-label">Hours</p>
                            <p class="contact-item-value">Tuesday - Saturday, 10:00 AM to 06:00 PM<br>Sunday - Monday, By Appointment</p>
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
                    <?php if ($dbError): ?>
                        <p class="admin-alert admin-alert--error"><?= e($dbError) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($formResult['success'])): ?>
                        <p class="admin-alert admin-alert--success"><?= e($formResult['success']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($formResult['errors'])): ?>
                        <div class="admin-alert admin-alert--error">
                            <?php foreach ($formResult['errors'] as $error): ?>
                                <p><?= e($error) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form id="appointmentRequestForm" method="post" action="contact.php#contact">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input" value="<?= e($old['name'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input" value="<?= e($old['email'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-input" value="<?= e($old['phone'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="message">Tell Us About Your Visit</label>
                            <textarea id="message" name="message" class="form-textarea"><?= e($old['message'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="form-submit">Request Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js?v=appointments-2"></script>
</body>
</html>
