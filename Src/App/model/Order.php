<?php

require_once 'UserModel.php';
require_once 'OrderItem.php';

class Order {
    private int $orderID;
    private UserModel $user;
    private array $items = []; // Array of OrderItem objects
    private string $status;
    private string $deliveryAddress;
    private float $totalPrice;

    public function __construct(UserModel $user, string $deliveryAddress) {
        $this->user = $user;
        $this->deliveryAddress = $deliveryAddress;
        $this->status = "Pending";
        $this->totalPrice = 0.0;
    }

    // Add an item to the order
    public function addItem(Product $product, int $quantity): void {
        $this->items[] = new OrderItem($product, $quantity);
        $this->totalPrice += $product->getPrice() * $quantity;
    }

    public function getTotalPrice(): float {
        return $this->totalPrice;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function saveToDatabase(PDO $pdo): bool {
        try {
            $pdo->beginTransaction();

            // Insert the order into the database
            $stmt = $pdo->prepare(
                "INSERT INTO orders (user_id, delivery_address, status, total_price) 
                VALUES (:user_id, :delivery_address, :status, :total_price)"
            );
            $stmt->execute([
                ':user_id' => $this->user->getId(),
                ':delivery_address' => $this->deliveryAddress,
                ':status' => $this->status,
                ':total_price' => $this->totalPrice,
            ]);
            $this->orderID = (int) $pdo->lastInsertId();

            // Insert each order item
            foreach ($this->items as $item) {
                $stmt = $pdo->prepare(
                    "INSERT INTO order_items (order_id, product_id, quantity, price) 
                    VALUES (:order_id, :product_id, :quantity, :price)"
                );
                $stmt->execute([
                    ':order_id' => $this->orderID,
                    ':product_id' => $item->getProduct()->getId(),
                    ':quantity' => $item->getQuantity(),
                    ':price' => $item->getProduct()->getPrice(),
                ]);
            }

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
