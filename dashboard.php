<?php
require_once 'config/config.php';
require_once 'includes/auth.php';
requireLogin();
$user = $_SESSION['user'];
?>
<?php include 'includes/header.php'; ?>
<h2>Dashboard</h2>

<div class="card">
    <p><strong>Welcome:</strong> <?= htmlspecialchars($user['userName']) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($user['userType']) ?></p>
</div>

<?php if ($user['userType'] === 'agent'): ?>
    <div class="card">
        <h3>Agent Actions</h3>
        <a href="add_property.php">Add Property</a>
    </div>
<?php endif; ?>

<div class="card">
    <h3>Common Actions</h3>
    <a href="properties.php">Browse Properties</a>
</div>

<?php include 'includes/footer.php'; ?>
