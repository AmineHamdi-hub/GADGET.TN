<?php
$title = 'Your Cart';
ob_start();
?>

<!-- Add CSS styles -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    td {
        font-size: 16px;
    }

    .total-price {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }

    form {
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    button:hover {
        background-color: #45a049;
    }

    .delete-btn {
        background-color: #ff4d4d;
    }

    .delete-btn:hover {
        background-color: #ff3333;
    }

    input[type="number"] {
        width: 50px;
        text-align: center;
    }
</style>

<!-- Cart content display -->
<div class="cart-container">
    <h1>Votre Panier</h1>

    <?php if (empty($cartItems)): ?>
        <p>Votre panier est vide. <a href="?action=home">Voir produits</a></p>
    <?php else: ?>
        <form action="index.php?action=cart" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <?php if ($item['product']): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product']->getName()) ?></td>
                            <td>
                                <input type="number" name="quantities[<?= $item['product']->getId() ?>]" value="<?= $item['quantity'] ?>" min="1">
                            </td>
                            <td><?= number_format($item['product']->getPrice() * $item['quantity'], 2) ?> TND</td>
                            <td>
                                <button type="submit" name="remove" value="<?= $item['product']->getId() ?>" class="delete-btn">Supprimer</button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Produit inconnu</td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Display total price -->
            <p class="total-price"><strong>Totale: <?= number_format($totalPrice, 2) ?> TND</strong></p>

            <button type="submit" name="update">Mettre à jour votre panier</button>
        </form>

        <form action="index.php" method="GET">
            <button type="submit" name="action" value="checkout">Passer à la caisse</button>
        </form>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once 'App/view/layouts/UserLayout.php';
?>
