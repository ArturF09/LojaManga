<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Obter o e-mail do usuário logado
$email = $_SESSION['email'];

// Conectar ao banco de dados
require('../config/conect.php');

try {
    // Buscar as ordens (pedidos) do usuário logado
    $stmt = $conn->prepare("
        SELECT orders.id AS order_id, orders.total, orders.status, orders.created_at, 
               products.name, products.image, order_items.quantity, order_items.price
        FROM orders
        JOIN order_items ON orders.id = order_items.order_id
        JOIN products ON order_items.product_id = products.id
        WHERE orders.email = :email
        ORDER BY orders.created_at DESC
    ");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Obter todos os pedidos do usuário com os produtos
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de erro na consulta
    echo "Erro ao recuperar os pedidos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="../css/orders.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="orders-container">
        <h1>Meus Pedidos</h1>

        <?php if (empty($orders)) : ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php else : ?>
            <?php
            $current_order = null; // Variável para rastrear o pedido atual
            foreach ($orders as $order) :
                // Verifica se é um novo pedido
                if ($current_order !== $order['order_id']) :
                    // Se não for o primeiro pedido, fecha o pedido anterior
                    if ($current_order !== null) {
                        echo '</div>'; // Fechar a div .order-items anterior
                    }
                    $current_order = $order['order_id'];
            ?>
            <div class="order-summary">
                <h2>Pedido #<?php echo $order['order_id']; ?></h2>
                <p>Total: €<?php echo number_format($order['total'], 2, ',', '.'); ?></p>
                <p>Status: <strong><?php echo ucfirst($order['status']); ?></strong></p>
                <p>Data: <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                <h3>Produtos:</h3>
                <div class="order-items">
            <?php endif; ?>

                <!-- Mostrar os detalhes dos produtos do pedido -->
                <div class="order-item">
                    <img src="../images/<?php echo $order['image']; ?>" alt="<?php echo $order['name']; ?>" class="product-image">
                    <div class="product-details">
                        <p>Produto: <?php echo $order['name']; ?></p>
                        <p>Quantidade: <?php echo $order['quantity']; ?></p>
                        <p>Preço Unitário: €<?php echo number_format($order['price'], 2, ',', '.'); ?></p>
                        <p>Total do Produto: €<?php echo number_format($order['price'] * $order['quantity'], 2, ',', '.'); ?></p>
                        <br>
                    </div>
                </div>

            <?php endforeach; ?>
            </div>
            <br>
        <?php endif; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
