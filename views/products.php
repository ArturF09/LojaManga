<!-- views/products.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'views/layout/header.php'; ?>
    <main>
        <h1>Produtos</h1>
        <div class="product-list">
            <?php foreach ($products as $product) : ?>
                <div class="product-item">
                    <img src="public/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2><?php echo $product['name']; ?></h2>
                    <p>Preço: R$<?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                    <a href="/add-to-cart?id=<?php echo $product['id']; ?>">Adicionar ao Carrinho</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include 'views/layout/footer.php'; ?>
</body>
</html>
