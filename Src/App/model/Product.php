<?php 
class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $categoryId; // Foreign key for category
    private $image; // Path or URL for the product image
    private $pdo;

    public function __construct($pdo, $id = null, $name = '', $price = 0.0, $description = '', $categoryId = null, $stock = 0, $image = '') {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->stock = $stock;
        $this->image = $image;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getCategoryId() { return $this->categoryId; }
    public function setCategoryId($categoryId) {
        if (!is_null($categoryId) && is_int($categoryId)) {
            $this->categoryId = $categoryId;
        } else {
            throw new InvalidArgumentException("Invalid category ID. Must be an integer.");
        }
    }

    public function getStock() { return $this->stock; }
    public function setStock($stock) {
        if (is_int($stock) && $stock >= 0) {
            $this->stock = $stock;
        } else {
            throw new InvalidArgumentException("Stock must be a non-negative integer.");
        }
    }

    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }

    // Save or Update product in the database
    public function save() {
        try {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imagePath = 'inc/images/' . basename($_FILES['image']['name']); // Le dossier d'upload
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $this->image = $imagePath; // Sauvegarder le chemin de l'image
                } else {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
            }
    
            if ($this->id) {
                // Mise à jour
                $query = "UPDATE products SET name = :name, price = :price, description = :description, category_id = :category_id, stock = :stock, image_url = :image WHERE id = :id";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':id', $this->id);
            } else {
                // Insertion
                $query = "INSERT INTO products (name, price, description, category_id, stock, image_url) VALUES (:name, :price, :description, :category_id, :stock, :image)";
                $stmt = $this->pdo->prepare($query);
            }
    
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':category_id', $this->categoryId);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':image', $this->image); // Utiliser le chemin de l'image
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur de base de données: " . $e->getMessage());
        }
    }
    

    // Find a product by ID
    public static function findById($pdo, $id) {
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Product(
                    $pdo,
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    $row['description'],
                    $row['category_id'],
                    $row['stock'],
                    $row['image_url']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error finding product: " . $e->getMessage());
        }
    }

    // Get all products from the database
    public static function getAll($pdo) {
        try {
            $query = "SELECT * FROM products";
            $stmt = $pdo->query($query);
            $products = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = new Product(
                    $pdo,
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    $row['description'],
                    $row['category_id'],
                    $row['stock'],
                    $row['image_url']
                );
            }

            return $products;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving all products: " . $e->getMessage());
        }
    }

    // Delete a product
    public function delete() {
        if ($this->id) {
            try {
                $query = "DELETE FROM products WHERE id = :id";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Error deleting product: " . $e->getMessage());
            }
        }
        throw new InvalidArgumentException("Product ID is required for deletion.");
    }
    public static function getByCategory($pdo, $categoryId) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :categoryId");
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
