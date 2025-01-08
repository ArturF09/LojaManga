<!-- views/layout/header.php -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<header>
    <div class="container">
        <h1><a href="index.php">OneManga</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="views/products.php">Produtos</a></li>
                <li><a href="views/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <?php
                if(!isset($_SESSION['email'])){
                ?>
                    <li><a href="views/login.php"><i class="fas fa-user"></i></a></li>
                <?php
                };
                
                if(isset($_SESSION['email'])){
                ?>
                    <li><a href="views/logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
                <?php
                };
                ?>
            </ul>
        </nav>
    </div>
</header>

<style>
/* Estilos específicos para o header */
* {
    margin: 0;
    padding: 0;
}
/* Remove margens e paddings apenas no header */
header {
    box-sizing: border-box;
    margin: 0;
    padding: 15px;
    background-color: #222;
    margin-bottom: 0px;
    color: #fff;
    width: 100%; /* Garante que o header ocupe 100% da largura */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Opcional: sombra suave */
}

/* Container interno com padding */
header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 12px 20px; /* Mantém o espaçamento interno do conteúdo */
}

/* Estilos do link no título */
header h1 a {
    color: #fff;
    text-decoration: none;
    font-size: 24px;
}

/* Estilos do menu */
header nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
}

header nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

header nav ul li a:hover {
    text-decoration: underline;
}
</style>
