<?php
session_start();
require_once 'App/controler/UserController.php';
require_once 'App/controler/CartControler.php';
require_once 'App/controler/ProductControler.php';
require_once 'App/controler/OrderControler.php';
require_once 'App/controler/DB.php';

// Initialize database connection
$pdo = Database::getInstance()->getConnection();
$userController = new UserController($pdo);
$productController = new ProductController($pdo);

// Initialize CartController only if the user is logged in
$cartController = isset($_SESSION['user_id']) 
    ? new CartController($pdo, UserModel::findById($pdo, $_SESSION['user_id'])) 
    : null;

// Determine action and route to the appropriate handler
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $productController->showAllProducts();
        break;

    case 'register':
        handleRegister($userController);
        break;

    case 'login':
        handleLogin($userController);
        break;

    case 'logout':
        handleLogout();
        break;

    case 'cart':
        handleCartActions($cartController);
        break;

    case 'profile':
        handleProfile($userController);
        break;

    case 'update_profile':
        handleUpdateProfile($pdo);
        break;

    case 'search':
        handleSearch();
        break;
    case 'category':
        handleCategory($productController);
        break;
    case 'checkout':
        handleCheckout( $pdo);
        break;
        
    default:
        echo "404: Unknown action.";
        break;
}

// Function Definitions

function handleRegister($userController) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController->register($_POST['username'], $_POST['email'], $_POST['password']);
    } else {
        $userController->showRegisterForm();
    }
}

function handleLogin($userController) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController->login($_POST['email'], $_POST['password']);
    } else {
        $userController->showLoginForm();
    }
}

function handleLogout() {
    session_destroy();
    header('Location: index.php');
    exit;
}

function handleCartActions($cartController) {
    if (!$cartController) {
        echo "Please log in to access your cart.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add'])) {
            $productId = (int)($_POST['product_id'] ?? 0);
            $quantity = (int)($_POST['quantity'] ?? 1);
            $cartController->addItemToCart($productId, $quantity);}
        elseif (isset($_POST['remove'])) {
            $productId = (int)$_POST['remove'];
            $cartController->removeItemFromCart($productId);
        } elseif (isset($_POST['update'])) {
            $quantities = $_POST['quantities'] ?? [];
            foreach ($quantities as $productId => $quantity) {
                $productId = (int)$productId;
                $quantity = (int)$quantity;
                $cartController->updateItemQuantity($productId, $quantity);
            }
        }
    }

    $cartController->showCartView();
}

function handleProfile($userController) {
    if (isset($_SESSION['user_id'])) {
        $userController->showUserProfile($_SESSION['user_id']);
    } else {
        echo "You must be logged in to access your profile.";
    }
}

function handleUpdateProfile($pdo) {
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to update your profile.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $type = $_POST['type'] ?? '';

        if ($type === 'password') {
            handlePasswordUpdate($pdo);
        } elseif ($type === 'email') {
            handleEmailUpdate($pdo);
        } else {
            echo "Invalid update type.";
        }
    }
}

function handlePasswordUpdate($pdo) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        echo "New password and confirmation password do not match.";
        return;
    }

    $user = UserModel::findById($pdo, $_SESSION['user_id']);
    if (!password_verify($currentPassword, $user->getPassword())) {
        echo "Current password is incorrect.";
        return;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    UserModel::updatePassword($pdo, $_SESSION['user_id'], $hashedPassword);
    echo "Password updated successfully.";
    header('Location: index.php?action=profile');
    exit;
}

function handleEmailUpdate($pdo) {
    $newEmail = $_POST['new_email'];

    if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        UserModel::updateEmail($pdo, $_SESSION['user_id'], $newEmail);
        echo "Email updated successfully.";
        header('Location: index.php?action=profile');
        exit;
    } else {
        echo "Invalid email format.";
    }
}

function handleSearch() {
    $query = $_GET['query'] ?? '';
    include 'App/view/search_results.php';
}
function handleCategory($productController) {
    $categoryId = (int)($_GET['category_id'] ?? 0); // Get category ID from query params
    $productController->showByCategory($categoryId);
}
function handleCheckout($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address = $_POST['address'] ?? '';

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $orderController = new OrderController($pdo);
            $orderController->checkout($userId, $address);
        } else {
            echo "Vous devez être connecté pour passer une commande.";
        }
    } else {
        include 'App/view/cart/checkout_form.php';
    }
}


?>
