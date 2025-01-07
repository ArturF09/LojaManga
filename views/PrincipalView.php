<?php
session_start();
require('../config/conect.php');



$sql_Prod = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
$stmt = $conn->prepare($sql_Prod);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(!isset($_SESSION['email'])) header('location:login.php');
?>

<?php include '../includes/header.php'; ?>

<link rel="stylesheet" href="../css/products.css">
<style>
/* Estilos para o contêiner da imagem */
.image-container {
    position: relative;
    text-align: center;
    color: white; /* Cor do texto */
}

/* Estilo para a imagem */
.image-container img {
    width: 100%; /* Faz a imagem ocupar 100% da largura do contêiner */
    height: auto; /* Mantém a proporção da imagem */
}

/* Estilo para o texto (h1) */
.image-container h1 {
    position: absolute;
    top: 50%; /* Posiciona o texto verticalmente no centro */
    left: 50%; /* Posiciona o texto horizontalmente no centro */
    transform: translate(-50%, -50%); /* Centraliza perfeitamente o texto */
    font-size: 3rem; /* Aumenta o tamanho da fonte */
    font-weight: bold; /* Torna o texto mais forte */
    text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.6); /* Sombra mais forte para dar destaque */
    padding: 20px; /* Adiciona espaçamento interno */
    background-color: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente atrás do texto */
    border-radius: 10px; /* Arredonda os cantos do fundo */
    max-width: 80%; /* Limita a largura do texto */
    margin: 0 auto; /* Centraliza o texto */
    box-sizing: border-box; /* Garantir que o padding não afete a largura */
    color: white;
}

/* Opção de melhorar a tipografia */
.image-container h1 {
    font-family: 'Arial', sans-serif; /* Define uma fonte mais legível */
    text-transform: uppercase; /* Coloca o texto em maiúsculas para mais impacto */
}

</style>

<main>
<div class="image-container">
    <img src="../images/fundo.jpg" alt="Fundo">
    <h1><?php echo "Bem-vindo, " . $reg_User['nome']; ?></h1>
</div>
</main>

<main>
        <h1>Alguns Produtos</h1>
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
