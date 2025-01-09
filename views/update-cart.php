<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../config/conect.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Verificar se os dados foram enviados via POST
if (!isset($_POST['product_id']) || !isset($_POST['quantity']) || empty($_POST['product_id']) || empty($_POST['quantity'])) {
    echo "Erro: Dados inválidos.";
    exit();
}

$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
$user_email = $_SESSION['email']; // Agora estamos usando o email diretamente

try {
    // Atualizar a quantidade do produto no carrinho para o usuário usando o email
    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE email = :email AND product_id = :product_id");
    $stmt->execute([':quantity' => $quantity, ':email' => $user_email, ':product_id' => $product_id]);

    
    // Redirecionar para o carrinho
    header('Location: cart.php');
    exit();
} catch (PDOException $e) {
    echo "Erro ao atualizar a quantidade no carrinho: " . $e->getMessage();
    exit();
}
?>
