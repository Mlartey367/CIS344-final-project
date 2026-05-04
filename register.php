<?php
require_once 'classes/RealEstateDatabase.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new RealEstateDatabase();

    $userName = trim($_POST['userName'] ?? '');
    $contactInfo = trim($_POST['contactInfo'] ?? '');
    $password = $_POST['password'] ?? '';
    $userType = $_POST['userType'] ?? '';

    if ($userName && $contactInfo && $password && $userType) {
        //TODO: Implement password hashing
       $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $db->addUser($userName, $contactInfo, $passwordHash, $userType);
            $message = 'Registration successful. You may now log in.';
        } catch (Throwable $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    } else {
        $message = 'Please fill in all fields.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<h2>Register</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Username</label>
    <input type="text" name="userName" required>

    <label>Contact Info</label>
    <input type="text" name="contactInfo" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>User Type</label>
    <select name="userType" required>
        <option value="">Select role</option>
        <option value="agent">Agent</option>
        <option value="buyer">Buyer</option>
        <option value="renter">Renter</option>
    </select>

    <button type="submit">Register</button>
</form>
<?php include 'includes/footer.php'; ?>
