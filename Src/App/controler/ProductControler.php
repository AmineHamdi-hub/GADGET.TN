<?php
require_once 'App/model/Product.php';

class ProductController {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // Pass PDO instance to the controller
    }

    // Display all products
    public function index() {
        try {
            $products = Product::getAll($this->pdo); // Pass PDO instance to getAll method
            include 'App/view/product/FindAllProductsView.php';
        } catch (Exception $e) {
            echo "Error fetching products: " . $e->getMessage();
        }
    }

    // Show a form to add a new product
    public function create() {
        include 'App/view/product/AddProductView.php';
    }

    // Store a new product
    public function store($data) {
        try {
            $product = new Product(
                $this->pdo,
                null,
                $data['name'],
                $data['price'],
                $data['description'],
                $data['categoryId'],
                $data['stock']
            );

            if ($product->save()) {
                header('Location: Adminpage.php?action=findAllProduct');
                exit();
            } else {
                echo "Error saving product.";
            }
        } catch (Exception $e) {
            echo "Error saving product: " . $e->getMessage();
        }
    }

    // Show a form to edit a product
    public function edit($id) {
        try {
            $product = Product::findById($this->pdo, $id); // Pass PDO instance to findById method
            if ($product) {
                include 'App/view/product/EditProductView.php';
            } else {
                echo "Product not found.";
            }
        } catch (Exception $e) {
            echo "Error fetching product: " . $e->getMessage();
        }
    }

    // Update an existing product
    public function update($id, $data) {
        try {
            $product = new Product(
                $this->pdo,
                $id,
                $data['name'],
                $data['price'],
                $data['description'],
                (int)$data['categoryId'],
                $data['stock'],
                Product::findById($this->pdo,$id)->getImage()
            );

            if ($product->save()) {
                header('Location: Adminpage.php?action=findAllProduct');
                exit();
            } else {
                echo "Error updating product.";
            }
        } catch (Exception $e) {
            echo "Error updating product: " . $e->getMessage();
        }
    }

    public function destroy($id) {
        include 'App/view/product/DestroyProductView.php';
    }

    // Delete a product
    public function delete($id) {
        try {
            $product = Product::findById($this->pdo, $id); // Pass PDO instance to findById method

            if ($product) {
                if ($product->delete()) {
                    header('Location: Adminpage.php?action=findAllProduct');
                    exit();
                } else {
                    echo "Error deleting product.";
                }
            } else {
                echo "Product not found.";
            }
        } catch (Exception $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }

    public function showAllProducts(): void {
        $products = Product::getAll($this->pdo); // Fetch all products
        include 'App/view/product/products.php';
    }

    // Show products by category
    public function showByCategory($categoryId) {
        try {
            $products = Product::getByCategory($this->pdo, $categoryId); // Fetch products by category
            include 'App/view/product/ProductsByCategoryView.php'; // View to display the products
        } catch (Exception $e) {
            echo "Error fetching products by category: " . $e->getMessage();
        }
    }
}
