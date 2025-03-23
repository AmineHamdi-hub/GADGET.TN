<?php
// Start session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "App/controler/DB.php"; // Get a reference to the database connection
$pdo = Database::getInstance()->getConnection();  // Include your database configuration file (PDO connection)

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['adminID'])) {
    $email = $_POST['email'];  // Get the email from form input
    $password = $_POST['password'];  // Get the password from form input

    // Fetch the admin record based on the email
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the admin exists and if the password is correct
    if ($admin && password_verify($password, $admin['password'])) {
        // Password is correct, log in the admin
        $_SESSION['admin_name']=$admin['name'];
        $_SESSION['adminID'] = $admin['adminID'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['role'] = $admin['role'];

        // Redirect to avoid re-submitting the form
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // Invalid login
        $error_message = "Invalid email or password.";
    }
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();  // Destroy the session to log out
    header('Location: ' . $_SERVER['PHP_SELF']);  // Redirect to the same page after logout
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inc/css/style_default.css">
</head>
<body>
<div class="navbar">
    <a href='Adminpage.php'><img src="inc/images/GADGET_admin.png" alt="Logo GADGET.TN" class="logo"/></a>
    
    <?php if (isset($_SESSION['adminID']) && $_SESSION['role'] === 'admin'): ?>
        <!-- Admin Dashboard Link -->
        <div class="admin-section">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</span>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="?logout=true">Logout</a>
        </div>
    <?php else: ?>
        <!-- Login Form in Header -->
        <form method="POST" action="" class="login-form">
            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    <?php endif; ?>
</div>
</body>
