<?php
require_once 'includes/header.php';
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "<script>window.location.href='dashboard.php';</script>";
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
    }
}
?>

<main class="container" style="max-width: 500px; padding: 60px 20px;">
    <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h1 style="font-family: 'Times New Roman', serif; text-align: center; margin-bottom: 20px;">Sign In</h1>
        
        <?php if ($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
        </form>
        
        <p style="text-align: center; margin-top: 20px; color: #666;">
            New to Goddady? <a href="signup.php" style="color: var(--primary-color); font-weight: bold;">Create an account</a>
        </p>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
