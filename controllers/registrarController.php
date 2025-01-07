<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../config/conect.php');

if (isset($_SESSION['email'])) {
    header('location:../views/Principal.php');
    exit();
}

if (isset($_POST['botao'])) {
    $estado = 0;

    // Usando PDO para evitar injeção SQL
    try {
        // Preparar a consulta para verificar se o email já existe
        $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        $num_verifica = $stmt->rowCount();  // Verifica quantos registros foram retornados

        // Verificar se todos os campos foram preenchidos
        if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordR'])) {
            if ($num_verifica == 0) { // Se o email não existir no banco
                // Verificar se as senhas são iguais
                if ($_POST['password'] == $_POST['passwordR']) {
                    // Usar password_hash para criar um hash seguro da senha
                    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    // Preparar a consulta de inserção
                    $stmt = $conn->prepare("INSERT INTO User (nome, username, email, password) VALUES (:nome, :username, :email, :password)");
                    $stmt->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);
                    $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
                    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                    $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
                    
                    if ($stmt->execute()) {
                        // Sucesso no cadastro, redireciona para a página de login
                        header('refresh:2;url=login.php');
                    } else {
                        $estado = 2; // Erro ao registrar
                    }
                } else {
                    // Senhas não coincidem
                    $estado = 4;
                    header('refresh:3;url=registrar.php');
                }
            } else {
                // Email já registrado
                $estado = 3;
            }
        }
    } catch (PDOException $e) {
        // Captura e exibe erros de conexão com o banco
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
