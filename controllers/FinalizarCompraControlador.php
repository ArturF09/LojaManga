<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

// Conectar ao banco de dados
require('../config/conect.php');

try {
    $conn->beginTransaction();

    // Buscar os itens do carrinho do usuário
    $stmt = $conn->prepare("
        SELECT cart.*, products.price, products.stock
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.email = :email
    ");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart_items)) {
        throw new Exception('O carrinho está vazio.');
    }

    // Calcular o total do pedido
    $total = 0;
    foreach ($cart_items as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Inserir na tabela `orders` com status 'completed'
    $stmt = $conn->prepare("
        INSERT INTO orders (email, total, status, created_at)
        VALUES (:email, :total, 'completed', NOW())
    ");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':total', $total);
    $stmt->execute();

    // Obter o ID do pedido recém-criado
    $order_id = $conn->lastInsertId();

    // Inserir os itens do carrinho na tabela `order_items`
    $stmt = $conn->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES (:order_id, :product_id, :quantity, :price)
    ");

    foreach ($cart_items as $item) {
        // Verificar se o estoque é suficiente
        if ($item['stock'] < $item['quantity']) {
            throw new Exception('Estoque insuficiente para o produto: ' . $item['product_id']);
        }

        // Inserir item na tabela `order_items`
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $item['price'], PDO::PARAM_STR);
        $stmt->execute();

        // Atualizar o estoque do produto
        $stmt_update_stock = $conn->prepare("
            UPDATE products
            SET stock = stock - :quantity
            WHERE id = :product_id
        ");
        $stmt_update_stock->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
        $stmt_update_stock->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
        $stmt_update_stock->execute();
    }

    // Limpar o carrinho do usuário
    $stmt = $conn->prepare("
        DELETE FROM cart
        WHERE email = :email
    ");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Confirmar a transação
    $conn->commit();

    // Redirecionar para uma página de sucesso
    header('Location: ../views/success.php');
    exit();

} catch (Exception $e) {
    // Se algo der errado, cancelar a transação
    $conn->rollBack();
    echo "Erro ao finalizar a compra: " . $e->getMessage();
}
?>
