<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Obter o ID do produto via GET
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$email = $_SESSION['email'];

// Conectar ao banco de dados
require('../config/conect.php');

try {
    // Remover o item do carrinho com base no e-mail do usuário
    $stmt = $conn->prepare("DELETE FROM cart WHERE email = :email AND product_id = :product_id");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirecionar de volta ao carrinho
    header('Location: cart.php');
    exit;

} catch (PDOException $e) {
    // Em caso de erro
    echo "Erro ao remover produto do carrinho: " . $e->getMessage();
}
