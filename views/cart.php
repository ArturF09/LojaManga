<?php
session_start();
if (!isset($_SESSION['email'])) header('Location: login.php');

// Obtém o e-mail do usuário logado
$email = $_SESSION['email'];

// Conectar ao banco de dados
require('../config/conect.php');

try {
    // Buscar os produtos no carrinho do usuário (usando o e-mail do usuário)
    $stmt = $conn->prepare("
        SELECT cart.*, products.name, products.price, products.image, products.stock
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.email = :email
    ");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Obter todos os itens do carrinho
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de erro na consulta
    echo "Erro ao recuperar o carrinho: " . $e->getMessage();
}

$total = 0; // Inicializando o total

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="cart-container">
        <h1>Carrinho de Compras</h1>

        <?php if (empty($cart_items)) : ?>
            <p>Seu carrinho está vazio.</p>
        <?php else : ?>
            <div class="cart-table">
                <?php foreach ($cart_items as $item) : ?>
                    <div class="cart-item">
                        <div class="cart-image">
                            <img src="../images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        </div>
                        <div class="cart-details">
                            <h2><?php echo $item['name']; ?></h2>
                            <form action="update-cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <label for="quantity">Quantidade:</label>
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                <button type="submit">Atualizar</button>
                            </form>
                            <p>Preço Unitário: €<?php echo number_format($item['price'], 2, ',', '.'); ?></p>
                            <p>Total: €<?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?></p>
                            <br>
                            <a class="remove-button" href="remove-from-cart.php?id=<?php echo $item['product_id']; ?>">Remover</a>
                        </div>
                    </div>
                    <?php 
                        // Acumular o total
                        $total += $item['price'] * $item['quantity']; 
                    ?>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Total: €<?php echo number_format($total, 2, ',', '.'); ?></h3>
                <a class="checkout-button" href="../controllers/FinalizarCompraControlador.php">Finalizar Compra</a>
            </div>
        <?php endif; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
