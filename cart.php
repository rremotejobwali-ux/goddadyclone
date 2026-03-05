<?php 
require_once 'includes/header.php'; 

// Handle remove action
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
    }
    // Redirect to avoid resubmission/clean URL
    echo "<script>window.location.href='cart.php';</script>";
    exit;
}
?>

<main class="container" style="padding: 40px 0; min-height: 60vh;">
    <h1 style="font-family: 'Times New Roman', serif; margin-bottom: 20px;">Shopping Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty. <a href="index.php" style="color: var(--primary-color);">Search for a domain.</a></p>
    <?php else: ?>
        <div style="display: flex; gap: 40px; flex-wrap: wrap;">
            <div style="flex: 2;">
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $index => $item): 
                    $total += $item['price'];
                ?>
                <div class="feature-card" style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3><?= htmlspecialchars($item['domain']) ?></h3>
                        <p><?= $item['term'] ?> Year Registration</p>
                    </div>
                    <div style="text-align: right;">
                        <h3><?= formatPrice($item['price']) ?></h3>
                        <a href="?action=remove&index=<?= $index ?>" style="color: #d9534f; font-size: 0.9rem;">Remove</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div style="flex: 1; border: 1px solid #ddd; padding: 20px; border-radius: 8px; height: fit-content;">
                <h3>Subtotal (<?= count($_SESSION['cart']) ?> items)</h3>
                <h2 style="font-size: 2.5rem; margin: 10px 0;"><?= formatPrice($total) ?></h2>
                <a href="checkout.php" class="btn btn-primary" style="width: 100%; text-align: center;">Proceed to Checkout</a>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>
