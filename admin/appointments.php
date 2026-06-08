<?php
require __DIR__ . '/../bootstrap.php';

use App\Core\Auth;
use App\Core\Database;
use App\Models\AppointmentRequest;

Auth::requireAdmin();

$appointments = (new AppointmentRequest(Database::getConnection()))->all();
$newAppointments = count(array_filter($appointments, static fn (array $appointment): bool => strtolower($appointment['status']) === 'new'));
$pageTitle = 'Appointments';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header">
        <div>
            <p class="admin-eyebrow">Client relations</p>
            <h1 class="heading-display admin-title">Appointment requests</h1>
            <p class="admin-page-intro">Review inquiries submitted through the private consultation form.</p>
        </div>
        <a class="admin-button admin-button--secondary" href="../contact.php" target="_blank" rel="noopener">Open public form <span aria-hidden="true">&nearr;</span></a>
    </div>

    <div class="admin-stats admin-stats--compact" aria-label="Appointment summary">
        <article class="admin-stat-card">
            <span class="admin-stat-label">Total inquiries</span>
            <strong><?= count($appointments) ?></strong>
            <span>All appointment requests</span>
        </article>
        <article class="admin-stat-card">
            <span class="admin-stat-label">Awaiting review</span>
            <strong><?= $newAppointments ?></strong>
            <span>Marked as new</span>
        </article>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-header">
            <div>
                <h2>Client inquiries</h2>
                <p>Newest requests appear first</p>
            </div>
        </div>
        <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($appointments === []): ?>
                    <tr>
                        <td class="admin-empty-state" colspan="6">No appointment requests yet.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><strong><?= e($appointment['full_name']) ?></strong></td>
                        <td><a class="admin-email-link" href="mailto:<?= e($appointment['email']) ?>"><?= e($appointment['email']) ?></a></td>
                        <td><?= e($appointment['phone']) ?></td>
                        <td class="admin-message-cell"><?= e($appointment['message']) ?></td>
                        <td><span class="admin-status admin-status--request"><?= e(ucfirst($appointment['status'])) ?></span></td>
                        <td class="admin-date-cell"><?= e($appointment['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
