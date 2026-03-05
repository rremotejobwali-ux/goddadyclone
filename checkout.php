<?php
session_start();
require_once 'db.php';

// Check auth
if (!isset($_SESSION['user_id'])) {
    // Save cart state implicitly (session persist) and redirect
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Mock processing
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $name = $item['domain'];
        $expiry = date('Y-m-d', strtotime('+1 year'));
        
        // Insert into DB linked to user
        $stmt = $pdo->prepare("INSERT INTO domains (user_id, domain_name, expiry_date) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $name, $expiry]);
    }
    // Clear cart
    $_SESSION['cart'] = [];
}

// Redirect to dashboard
header('Location: dashboard.php?success=1');
exit;

