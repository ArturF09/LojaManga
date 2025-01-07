
<!-- Cabeçalho -->
<?php include '../includes/header.php'; ?>

<?php include '../controllers/registrarCon.php'; ?>

<section class="register-section">
    <div class="register-container">
        <div class="register-form-wrapper">
            <?php
            if (isset($estado)) {
                if ($estado == 0) {
            ?>
                    <div class="alert alert-success" role="alert">
                        Conta criada com sucesso! Aguarde um pouco.
                    </div>
                <?php
                } else {
                    if ($estado == 1) {
                ?>
                        <div class="alert alert-danger" role="alert">
                            Ocorreu um erro. Tente novamente!
                        </div>
                    <?php
                    } else {
                        if ($estado == 2) {
                    ?>
                            <div class="alert alert-danger" role="alert">
                                O email já está associado a uma conta!
                            </div>
                        <?php
                        } else {
                            if ($estado == 3) {
                        ?>
                                <div class="alert alert-danger" role="alert">
                                    Ocorreu um erro ou o email já existe!
                                </div>
                            <?php
                            } else {
                                if ($estado == 4) {
                            ?>
                                    <div class="alert alert-danger" role="alert">
                                        A senha não está igual!
                                    </div>
                                <?php
                                }
                            }
                        }
                    }
                }
            }
            ?>

            <form method="post">
                <h3 class="form-title">Registo</h3>
                <div class="input-group">
                    <label for="nome" class="input-label">Nome<span class="required">*</span></label>
                    <input type="text" name="nome" id="nome" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="username" class="input-label">Username<span class="required">*</span></label>
                    <input type="text" name="username" id="username" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="email" class="input-label">Email<span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="password" class="input-label">Senha<span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="passwordR" class="input-label">Repetir Senha<span class="required">*</span></label>
                    <input type="password" name="passwordR" id="passwordR" class="input-field" required>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" required>
                    <a href="PoliticaEPrivacidade.php">
                        <label> Política de Privacidade</label>
                    </a>
                </div>
                <button type="submit" name="botao" class="submit-button">Registrar</button>
            </form>
        </div>
    </div>
</section>

<style>
    /* Estilos para a página de registro */
.register-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
    padding: 20px;
}

.register-container {
    width: 100%;
    max-width: 600px; /* Limita a largura do formulário */
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.register-form-wrapper {
    padding: 20px;
}

.form-title {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
}

.input-group {
    margin-bottom: 20px;
}

.input-label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.input-field {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.input-field:focus {
    border-color: #986cec;
    outline: none;
    background-color: #fff;
}

.checkbox-group {
    margin-bottom: 20px;
    font-size: 14px;
}

.submit-button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #986cec;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #7a6db0;
}

/* Estilos para as mensagens de alerta */
.alert {
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

/* Responsividade para telas menores */
@media (max-width: 767px) {
    .register-container {
        max-width: 100%;
        padding: 20px;
    }
}

</style>

<!-- Footer -->
<?php include '../includes/footer.php'; ?>