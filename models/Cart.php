<?php
// models/Cart.php
class Cart {
    public function addProductToCart($product_id) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = 1;  // Adiciona o produto ao carrinho
        } else {
            $_SESSION['cart'][$product_id]++;    // Incrementa a quantidade
        }
    }

    public function getCartProducts($db) {
        $cart_products = [];
        if (isset($_SESSION['cart'])) {
            $ids = array_keys($_SESSION['cart']);
            if (!empty($ids)) {
                $query = "SELECT * FROM products WHERE id IN (" . implode(',', $ids) . ")";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $cart_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $cart_products;
    }
}
