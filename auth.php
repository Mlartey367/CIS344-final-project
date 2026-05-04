<?php
function requireLogin(): void {
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}

function requireRole(array $roles): void {
    requireLogin();

    if (!in_array($_SESSION['user']['userType'], $roles, true)) {
        die('Access denied.');
    }
}
?>
