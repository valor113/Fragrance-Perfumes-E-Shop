<?php
require __DIR__ . '/../bootstrap.php';

use App\Core\Auth;
use App\Core\Database;
use App\Models\AppointmentRequest;

Auth::requireAdmin();

$appointments = (new AppointmentRequest(Database::getConnection()))->all();
$pageTitle = 'Appointments';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-panel">
    <div class="admin-heading-row">
        <div>
            <p class="text-label">Contact Form Requests</p>
            <h1 class="heading-display admin-title">Appointments</h1>
        </div>
        <a class="btn-primary" href="../contact.php">Public Form</a>
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
                        <td colspan="6">No appointment requests yet.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= e($appointment['full_name']) ?></td>
                        <td><a href="mailto:<?= e($appointment['email']) ?>"><?= e($appointment['email']) ?></a></td>
                        <td><?= e($appointment['phone']) ?></td>
                        <td><?= e($appointment['message']) ?></td>
                        <td><?= e($appointment['status']) ?></td>
                        <td><?= e($appointment['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
