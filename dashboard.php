<?php 
require_once 'includes/header.php'; 
require_once 'db.php';

// Check authentication
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Validate ownership before action
    $check_stm = $pdo->prepare("SELECT id FROM domains WHERE id = ? AND user_id = ?");
    $check_stm->execute([$id, $user_id]);
    if (!$check_stm->fetch()) {
        die("Unauthorized access to this domain.");
    }
    
    if ($_GET['action'] == 'remove') {
        $stmt = $pdo->prepare("DELETE FROM domains WHERE id = ?");
        $stmt->execute([$id]);
    }
    
    if ($_GET['action'] == 'renew') {
        // Fetch current expiry first
        $stmt = $pdo->prepare("SELECT expiry_date FROM domains WHERE id = ?");
        $stmt->execute([$id]);
        $domain = $stmt->fetch();
        
        if ($domain) {
            $new_expiry = date('Y-m-d', strtotime($domain['expiry_date'] . ' + 1 year'));
            $update = $pdo->prepare("UPDATE domains SET expiry_date = ? WHERE id = ?");
            $update->execute([$new_expiry, $id]);
        }
    }
    
    // Redirect to clear query params
    header('Location: dashboard.php');
    exit;
}

// Fetch domains from DB for this user only
$stmt = $pdo->prepare("SELECT * FROM domains WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$domains = $stmt->fetchAll();
?>

<main class="container dashboard-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="font-family: 'Times New Roman', serif;">My Products</h1>
        <button class="btn btn-teal">Add New Product</button>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div style="background-color: #d8efe3; padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #006066;">
            <strong>Success!</strong> Thank you for your order.
        </div>
    <?php endif; ?>

    <h2 style="font-size: 1.2rem; border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">Domains</h2>

    <?php if (empty($domains)): ?>
        <p>You have no domains. <a href="index.php">Find one today!</a></p>
    <?php else: ?>
        <div class="domain-list">
            <?php foreach ($domains as $domain): ?>
            <div class="domain-item">
                <div class="domain-info">
                    <h3><?= htmlspecialchars($domain['domain_name']) ?></h3>
                    <p style="color: #666; font-size: 0.9rem;">Expires on <?= $domain['expiry_date'] ?></p>
                    <p class="domain-status"><i class="fas fa-circle" style="font-size: 0.6rem;"></i> <?= $domain['status'] ?></p>
                </div>
                <div>
                     <a href="?action=renew&id=<?= $domain['id'] ?>" class="btn" style="border: 1px solid #ddd; font-size: 0.9rem; margin-right: 10px;">Renew</a>
                     <a href="?action=remove&id=<?= $domain['id'] ?>" class="btn" style="background-color: #f5f5f5; color: #d9534f; font-size: 0.9rem;">Start Transfer</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>

