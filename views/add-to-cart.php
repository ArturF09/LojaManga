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

// Verificar se o ID do produto está definido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Erro: ID do produto não foi passado.";
    exit();
}

$product_id = intval($_GET['id']);
$user_email = $_SESSION['email']; // Agora estamos usando o email diretamente

try {
    // Verificar se o produto já está no carrinho para o usuário usando o email
    $stmt = $conn->prepare("SELECT * FROM cart WHERE email = :email AND product_id = :product_id");
    $stmt->execute([':email' => $user_email, ':product_id' => $product_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // Produto já está no carrinho, aumentar a quantidade
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE email = :email AND product_id = :product_id");
        $stmt->execute([':email' => $user_email, ':product_id' => $product_id]);
        $_SESSION['message'] = "A quantidade do produto foi aumentada no seu carrinho!";
    } else {
        // Produto não está no carrinho, inserir
        $stmt = $conn->prepare("INSERT INTO cart (email, product_id, quantity, added_at) VALUES (:email, :product_id, 1, NOW())");
        $stmt->execute([':email' => $user_email, ':product_id' => $product_id]);
        $_SESSION['message'] = "Produto adicionado ao carrinho com sucesso!";
    }

    // Redirecionar para a página de produtos
    header('Location: products.php');
    exit();
} catch (PDOException $e) {
    echo "Erro ao adicionar produto ao carrinho: " . $e->getMessage();
    exit();
}
?>
