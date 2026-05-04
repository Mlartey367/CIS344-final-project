<?php
require_once 'classes/RealEstateDatabase.php';
$db = new RealEstateDatabase();

$propertyId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$property = $db->getPropertyById($propertyId);
?>
<?php include 'includes/header.php'; ?>
<h2>Property Details</h2>

<?php if (!$property): ?>
    <p class="error">Property not found.</p>
<?php else: ?>
    <div class="card">
        <h3><?= htmlspecialchars($property['title']) ?></h3>
        <p><strong>Type:</strong> <?= htmlspecialchars($property['propertyType']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($property['address']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($property['city']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($property['price']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($property['status']) ?></p>
        <p><strong>Agent:</strong> <?= htmlspecialchars($property['agentName']) ?></p>
    </div>

    <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['userType'], ['buyer', 'renter'], true)): ?>
        <a href="submit_inquiry.php?propertyId=<?= (int)$property['propertyId'] ?>">Submit Inquiry</a>
    <?php endif; ?>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
