<?php
require_once 'config/config.php';
require_once 'includes/auth.php';
require_once 'classes/RealEstateDatabase.php';

requireRole(['buyer', 'renter']);

$db = new RealEstateDatabase();
$message = '';

$propertyId = isset($_GET['propertyId']) ? (int)$_GET['propertyId'] : (int)($_POST['propertyId'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_SESSION['user']['userId'];
    $messageText = trim($_POST['message'] ?? '');

    if ($propertyId > 0 && $messageText !== '') {
        try {
            $db->addInquiry($userId, $propertyId, $messageText);
            $message = 'Inquiry submitted successfully.';
        } catch (Throwable $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    } else {
        $message = 'Please enter a message.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<h2>Submit Inquiry</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="propertyId" value="<?= (int)$propertyId ?>">

    <label>Message</label>
    <textarea name="message" rows="6" required></textarea>

    <button type="submit">Send Inquiry</button>
</form>
<?php include 'includes/footer.php'; ?>
