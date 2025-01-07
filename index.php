    <?php
        if(isset($_SESSION['email'])){
            header('location:Principal.php');
        } 
    ?>
    
    <!-- Cabeçalho -->
    <?php include 'includes/header.html'; ?>

    <!-- Banner Principal -->
    <section class="banner">
        <h2>Explore os Melhores Livros de Animes!</h2>
        <p>Mangás, Novels e muito mais...</p>
    </section>

    <!-- Seção de Livros em Destaque -->
    <section class="books-section">
        <h2>Livros em Destaque</h2>
        <div class="book-list">
            <div class="book-item">
                <img src="demon-slayer.jpg" alt="Demon Slayer">
                <h3>Demon Slayer</h3>
                <p>A partir de R$ 29,90</p>
            </div>
            <div class="book-item">
                <img src="one-piece.jpg" alt="One Piece">
                <h3>One Piece</h3>
                <p>A partir de R$ 39,90</p>
            </div>
            <div class="book-item">
                <img src="naruto.jpg" alt="Naruto">
                <h3>Naruto</h3>
                <p>A partir de R$ 34,90</p>
            </div>
            <div class="book-item">
                <img src="attack-on-titan.jpg" alt="Attack on Titan">
                <h3>Attack on Titan</h3>
                <p>A partir de R$ 42,90</p>
                <h3>Victor delicia</h3>
                <p>A partir de R$ 2,99</p>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.html'; ?>

