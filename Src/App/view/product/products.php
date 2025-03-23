<?php
ob_start();
?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .product-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product-box:hover {
            transform: scale(1.05);
        }
        .product-box img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-price {
            color: #28a745;
            font-size: 16px;
            margin: 10px 0;
        }
        .add-to-cart {
            display: inline-block;
            padding: 10px 15px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .add-to-cart:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container">
    <h1>Nos produits</h1>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-box">
                <img src="<?= htmlspecialchars($product->getImage()) ?>" alt="Product Image">
                <div class="product-name"><?= htmlspecialchars($product->getName()) ?></div>
                <!-- Display price in Tunisian dinars (TND) -->
                <div class="product-price"><?= htmlspecialchars($product->getPrice()) ?> TND</div>
                <form action="index.php?action=cart" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="add" value="1">
                    <button type="submit" class="add-to-cart">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');?>
