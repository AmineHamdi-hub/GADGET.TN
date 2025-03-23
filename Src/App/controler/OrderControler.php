<?php

class OrderController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkout($userId, $address) {
        // Fetch cart data from the cookie
        $cartData = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

        if (empty($cartData)) {
            echo "Votre panier est vide.";
            return;
        }

        if (empty($address)) {
            echo "L'adresse est requise pour passer la commande.";
            return;
        }

        try {
            $this->pdo->beginTransaction();

            // Insert order into the `orders` table
            $totalPrice = 0;
            foreach ($cartData as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            $stmt = $this->pdo->prepare("
                INSERT INTO orders (user_id, total_price, address, status)
                VALUES (:user_id, :total_price, :address, 'pending')
            ");
            $stmt->execute([
                'user_id' => $userId,
                'total_price' => $totalPrice,
                'address' => $address,
            ]);

            $orderId = $this->pdo->lastInsertId();

            // Insert items into the `order_items` table
            foreach ($cartData as $item) {
                $stmt = $this->pdo->prepare("
                    INSERT INTO order_items (order_id, product_id, quantity, price)
                    VALUES (:order_id, :product_id, :quantity, :price)
                ");
                $stmt->execute([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $this->pdo->commit();

            // Clear the cart cookie
            setcookie('cart', '', time() - 3600, '/');
            echo "Commande passée avec succès !";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Erreur lors de la validation de la commande : " . $e->getMessage();
        }
    }
}


