<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Finalizada</title>
    <link rel="stylesheet" href="../css/success.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="success-container">
        <h1>Compra Finalizada com Sucesso!</h1>
        <p>Obrigado por sua compra. <br> Olhe nas encomendas para ver os detalhes dos produtos</p>
        <p>Status do pedido: <strong>Completed</strong></p>
        <a href="Principal.php">Voltar à loja</a>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
