<?php
require_once 'includes/functions.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action === 'search') {
    $domain = trim($_GET['domain'] ?? '');
    
    if (empty($domain)) {
        echo json_encode(['error' => 'Domain name is required.']);
        exit;
    }
    
    // Auto-append .com if no extension
    if (!strpos($domain, '.')) {
        $domain .= '.com';
    }
    
    $available = checkDomainAvailability($domain);
    $price = getDomainPrice(pathinfo($domain, PATHINFO_EXTENSION));
    
    echo json_encode([
        'domain' => $domain,
        'available' => $available,
        'price' => $price,
        'formatted_price' => formatPrice($price),
        'currency' => '$',
        'upsell' => [
            'product' => 'Website Builder + Marketing',
            'price' => 9.99,
            'description' => 'Start for free, upgrade to launch.'
        ]
    ]);
    exit;
}

if ($action === 'add_to_cart') {
    // Read JSON input
    $data = json_decode(file_get_contents('php://input'), true);
    $domain = $data['domain'] ?? '';
    $price = $data['price'] ?? 0;
    
    if ($domain) {
        // Check if already in cart
        $exists = false;
        foreach ($_SESSION['cart'] as $item) {
            if ($item['domain'] === $domain) {
                $exists = true;
                break;
            }
        }
        
        if (!$exists) {
            $_SESSION['cart'][] = [
                'domain' => $domain,
                'price' => $price,
                'term' => 1 // years
            ];
        }
        
        echo json_encode(['success' => true, 'cart_count' => count($_SESSION['cart'])]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

echo json_encode(['error' => 'Invalid action']);
