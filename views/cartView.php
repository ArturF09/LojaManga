<?php
session_start();
if(!isset($_SESSION['email'])) header('location:login.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php include '../includes/header.php'; ?>

    <main>
        <h1>Seu Carrinho</h1>
        <div class="cart-list">
            <?php if (count($cart_products) > 0) : ?>
                <?php foreach ($cart_products as $product) : ?>
                    <div class="cart-item">
                        <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h2><?php echo $product['name']; ?></h2>
                        <p>Preço: R$<?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                        <p>Quantidade: <?php echo $_SESSION['cart'][$product['id']]; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Seu carrinho está vazio.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
