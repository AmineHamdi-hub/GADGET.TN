<?php
// Start session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inc/css/style.css">
    <title>GADGET.TN</title>
</head>
<body>
<div class="navbar">
    <a href="index.php"><img src="inc/images/GADGET.png" alt="Logo GADGET.TN" class="logo" /></a>
    <form action="?action=search" method="get" class="search-bar">
        <input type="text" name="query" placeholder="Rechercher..." class="search-input" />
        <button type="submit" class="search-button">Rechercher</button>
    </form>
    <div class="account-cart">
        <?php
        // Check if user is logged in
        if (isset($_SESSION['username'])) {
            echo '<a href="index.php?action=profile" class="signin">Bonjour, ' . htmlspecialchars($_SESSION['username']) . '</a>';
            echo '<a href="index.php?action=logout" class="signin">Se Déconnecter</a>';

            // Show cart when logged in
            $cartCount = 0;
            if (isset($_COOKIE['cart'])) {
                $cartData = json_decode($_COOKIE['cart'], true);
                if (is_array($cartData)) {
                    $cartCount = count($cartData);
                }
            }
            echo '<a href="index.php?action=cart" class="cart">
                    <img src="inc/images/CART.png" alt="Cart" />
                    <span class="cart-count">' . $cartCount . '</span>
                  </a>';
        } else {
            echo '<a href="index.php?action=register" class="signin">Register</a>';
            echo '<a href="index.php?action=login" class="signin">Sign In</a>';
        }
        ?>
    </div>
</div>
</body>
</html>
