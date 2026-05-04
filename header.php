<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Agency Portal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <h1>Real Estate Agency Portal</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="properties.php">Properties</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
    <hr>
</header>
<main>
