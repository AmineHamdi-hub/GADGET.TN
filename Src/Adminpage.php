<?php
session_start();
require_once 'App/controler/ProductControler.php';
require_once 'App/controler/DB.php';
// Vérification de l'état de la session
if (!isset($_SESSION['adminID'])) {
    include('inc/header_default.php');
} else {
    

    // Obtenir une connexion à la base de données
    $pdo = Database::getInstance()->getConnection();

    // Instancier le contrôleur des produits
    $productController = new ProductController($pdo);

    // Gestionnaire de routage simple
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'findAllProduct':
                $productController->index();
                break;

            case 'addProduct':
                $productController->create();
                break;

            case 'insertProduct':
                if (!empty($_POST)) {
                    $productController->store($_POST);
                } else {
                    echo "Erreur : Aucune donnée de produit fournie.";
                }
                break;

            case 'editProduct':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $productController->edit($_GET['id']);
                } else {
                    echo "Erreur : Un ID de produit valide est requis.";
                }
                break;

            case 'updateProduct':
                if (isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_POST)) {
                    $productController->update($_GET['id'], $_POST);
                } else {
                    echo "Erreur : ID de produit ou données de mise à jour manquantes.";
                }
                break;

            case 'destroyProduct':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $productController->destroy($_GET['id']);
                } else {
                    echo "Erreur : Un ID de produit valide est requis.";
                }
                break;
            case 'deleteProduct': // Gestion des deux cas
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $productController->delete($_GET['id']);
                } else {
                    echo "Erreur : Un ID de produit valide est requis.";
                }
                break;

            default:
                echo "Erreur : Action '$action' non reconnue.";
        }
    } else {
        // Action par défaut si aucun paramètre n'est fourni
        $productController->index();
    }
}
?>
