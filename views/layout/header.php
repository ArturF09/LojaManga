<!-- views/layout/header.php -->
<header>
    <div class="container">
        <h1><a href="/home">OneManga</a></h1>
        <nav>
            <ul>
                <li><a href="/home">Início</a></li>
                <li><a href="/products">Produtos</a></li>
                <li><a href="/cart">Carrinho</a></li>
            </ul>
        </nav>
    </div>
</header>

<style>
/* Estilos do Header */
header {
    background-color: #222;
    padding: 10px 0;
    color: #fff;
}

header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

header h1 a {
    color: #fff;
    text-decoration: none;
    font-size: 24px;
}

header nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}

header nav ul li {
    display: inline;
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
