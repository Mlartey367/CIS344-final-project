<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'classes/RealEstateDatabase.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new RealEstateDatabase();
    $userName = trim($_POST['userName'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = $db->getUserByUsername($userName);
    //TODO: Verify Password by comparing it with hashed password 
    if ($user && password_verify($password, $user['passwordHash'])) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Invalid username or password.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<h2>Login</h2>
<?php if ($message): ?>
    <p class="error"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Username</label>
    <input type="text" name="userName" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>
<?php include 'includes/footer.php'; ?>
