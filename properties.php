<?php
require_once 'classes/RealEstateDatabase.php';
$db = new RealEstateDatabase();
$properties = $db->getAllProperties();
?>
<?php include 'includes/header.php'; ?>
<h2>Property Listings</h2>

<?php if (!$properties): ?>
    <p>No properties found.</p>
<?php endif; ?>

<?php foreach ($properties as $property): ?>
    <div class="card">
        <h3><?= htmlspecialchars($property['title']) ?></h3>
        <p><strong>Type:</strong> <?= htmlspecialchars($property['propertyType']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($property['address']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($property['city']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($property['price']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($property['status']) ?></p>
        <p><strong>Agent:</strong> <?= htmlspecialchars($property['agentName']) ?></p>
        <a href="property_details.php?id=<?= (int)$property['propertyId'] ?>">View Details</a>
    </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
