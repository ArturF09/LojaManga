<!-- views/cart.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'views/layout/header.php'; ?>
    <main>
        <h1>Seu Carrinho</h1>
        <div class="cart-list">
            <?php if (count($cart_products) > 0) : ?>
                <?php foreach ($cart_products as $product) : ?>
                    <div class="cart-item">
                        <img src="public/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
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
    <?php include 'views/layout/footer.php'; ?>
</body>
</html>
