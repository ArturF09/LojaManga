<?php
// controllers/CartController.php
require_once 'models/Cart.php';
require_once 'config/conect.php';

class CartController {
    public function __construct() {
        session_start();
    }

    public function addToCart($product_id) {
        $cart = new Cart();
        $cart->addProductToCart($product_id);

        header("Location: /products");
    }

    public function viewCart() {
        $cart = new Cart();
        $cart_products = $cart->getCartProducts($GLOBALS['conn']);

        require_once 'views/cart.php';
    }
}
