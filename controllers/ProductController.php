<?php
// controllers/ProductController.php
require_once 'models/Product.php';

class ProductController {
    public function showProducts() {
        $product = new Product();
        $stmt = $product->getAllProducts();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/products.php';
    }
}
