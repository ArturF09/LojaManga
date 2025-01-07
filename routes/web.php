<?php
// routes/web.php
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';

if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/Principal') {
    require_once 'views/Principal.php';
} elseif ($_SERVER['REQUEST_URI'] == '/products') {
    $controller = new ProductController();
    $controller->showProducts();
} elseif (strpos($_SERVER['REQUEST_URI'], '/add-to-cart') !== false) {
    $controller = new CartController();
    $product_id = $_GET['id'];
    $controller->addToCart($product_id);
} elseif ($_SERVER['REQUEST_URI'] == '/cart') {
    $controller = new CartController();
    $controller->viewCart();
} else {
    echo "404 Not Found";
}
