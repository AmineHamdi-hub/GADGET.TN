<?php class CartController {
    private $pdo;
    private $user;
    private $cart;

    public function __construct($pdo,$user) {
        $this->user = $user;
        $this->pdo=$pdo;
        $this->loadCartFromCookie();
    }


    /**
     * Load the cart from the cookie.
     */
    private function loadCartFromCookie() {
        if (isset($_COOKIE['cart'])) {
            $this->cart = json_decode($_COOKIE['cart'], true);
        } else {
            $this->cart = [];
        }
    }

    /**
     * Save the cart back to the cookie.
     */
    private function saveCartToCookie() {
        setcookie('cart', json_encode($this->cart), time() + (86400 * 30), "/"); // Cookie expires in 30 days
    }

    /**
     * Add an item to the cart.
     */
    public function addItemToCart($productId, $quantity) {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId] += $quantity;
        } else {
            $this->cart[$productId] = $quantity;
        }
        $this->saveCartToCookie();
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItemFromCart($productId) {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
        }
        $this->saveCartToCookie();
    }

    /**
     * Update the quantity of an item in the cart.
     */
    public function updateItemQuantity($productId, $quantity) {
        if ($quantity <= 0) {
            $this->removeItemFromCart($productId);
        } else {
            $this->cart[$productId] = $quantity;
        }
        $this->saveCartToCookie();
    }

    /**
     * Get all items in the cart.
     */
    public function getItems() {
        return $this->cart;
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function getTotalPrice() {
        $total = 0;
        foreach ($this->cart as $productId => $quantity) {
            $product = Product::findById($this->pdo, $productId);
            if ($product) {
                $total += $product->getPrice() * $quantity;
            }
        }
        return $total;
    }

    /**
     * Show the cart view.
     */
    public function showCartView() {
        $pdo = $this->pdo;
        $cartItems = [];
        foreach ($this->cart as $productId => $quantity) {
            $product = Product::findById($this->pdo, $productId);
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    
        // Appeler la méthode pour obtenir le prix total
        $totalPrice = $this->getTotalPrice();
    
        include 'App/view/cart/cart.php';
    }
    
}
