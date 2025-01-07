<?php
session_start();
if(!isset($_SESSION['email'])) header('location:login.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectando ao banco de dados
require('../config/conect.php');

try {
    // Preparando a consulta SQL para buscar todos os produtos
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    // Recuperando os produtos como um array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Caso haja erro de conexão ou consulta
    echo "Erro ao recuperar produtos: " . $e->getMessage();
}
?>

<!-- views/products.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Produtos</h1>
        <div class="product-list">
            <?php foreach ($products as $product) : ?>
                <div class="product-item">
                    <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2><?php echo $product['name']; ?></h2>
                    <p>Preço: R$<?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                    <a href="/add-to-cart?id=<?php echo $product['id']; ?>">Adicionar ao Carrinho</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
