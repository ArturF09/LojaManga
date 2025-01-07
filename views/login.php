
<!-- Cabeçalho -->
<?php include '../includes/header.php'; ?>

<?php include '../controllers/loginCon.php'; ?>

<section class="login-section">
    <div class="login-container">
        <div class="login-form-wrapper">
            <form method="post">
                <h3 class="login-title">Login</h3>
                <div class="input-group">
                    <label for="email" class="input-label">Email<span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="password" class="input-label">Senha<span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="input-field" required>
                </div>
                <div class="login-actions">
                    <div class="submit-group">
                        <button type="submit" name="botao" class="login-button">Log in</button>
                    </div>
                    <br>
                    <div class="register-link">
                        <label for="register">Não tem uma conta?</label>
                        <a href="registrar.php" id="register"> Registre-se aqui!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
/* Estilos para o formulário de login */
.login-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 66vh;
    background-color: #f5f5f5; /* Cor de fundo suave */
    padding: 20px;
}

.login-container {
    width: 100%;
    max-width: 400px; /* Limita a largura do formulário */
    background-color: #fff; /* Fundo branco */
    padding: 20px;
    border-radius: 10px; /* Bordas arredondadas */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
}

.login-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.input-group {
    margin-bottom: 15px;
}

.input-label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.input-field {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.input-field:focus {
    border-color: #986cec; /* Cor do foco */
    outline: none;
    background-color: #fff;
}

.login-actions {
    text-align: center;
}

.submit-group {
    margin-bottom: 10px;
}

.login-button {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: #986cec;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.login-button:hover {
    background-color: #7a6db0; /* Cor mais escura no hover */
}

.register-link {
    font-size: 14px;
}

.register-link a {
    color: #986cec;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

</style>
<!-- Footer -->
<?php include '../includes/footer.php'; ?>