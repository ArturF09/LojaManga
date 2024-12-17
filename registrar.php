<?php
session_start();
require('conect.php');  // Certifique-se de que 'conect.php' já esteja configurado para PDO

if (isset($_SESSION['email'])) {
    header('location:index.html');
    exit();  // Sempre use exit após redirecionamentos
}

if (isset($_POST['botao'])) {
    $estado = 0;

    // Verifica se todos os campos necessários estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordR'])) {

        // Verifica se o email já está registrado
        $sql_verifica = "SELECT * FROM User WHERE email = :email";
        $stmt_verifica = $conn->prepare($sql_verifica);
        $stmt_verifica->bindParam(':email', $_POST['email']);
        $stmt_verifica->execute();
        $num_verifica = $stmt_verifica->rowCount();
        
        if ($num_verifica == 0) {
            // Hash seguro da senha usando password_hash
            $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $passR = password_hash($_POST['passwordR'], PASSWORD_BCRYPT);

            // Verifica se as senhas correspondem
            if (password_verify($_POST['passwordR'], $pass)) {
                // Insere o novo usuário no banco de dados
                $sql = "INSERT INTO User (nome, username, email, password) VALUES (:nome, :username, :email, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $_POST['nome']);
                $stmt->bindParam(':username', $_POST['username']);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->bindParam(':password', $pass);

                if ($stmt->execute()) {
                    header('refresh:2;url=login.php');
                    exit();
                } else {
                    $estado = 2;  // Erro ao inserir no banco de dados
                }
            } else {
                $estado = 4;  // Senhas não correspondem
                header('refresh:3;url=registrar.php');
                exit();
            }
        } else {
            $estado = 3;  // Email já registrado
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<section class="content account">
        <div class="container">
        	<div class="row">
            	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                	<div class="login-form-wrapper" style="border: 4px solid #986cec; border-radius: 15px; box-shadow: 0 5px 5px rgba(0,0,0,0.5);">
    <?php
        if(isset($estado)){
                            if($estado==0){
                                 ?>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="alert alert-success" role="alert" align="center">
                                           Conta criada com sucesso! aguarde um pouco
                                          </div>
                                      </div>
                                </div>
                                    <?php
                                    
                                } else {
                                    if($estado==1){
                                        ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert" align="center">
                                              Ocorreu um erro tente novamente!
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                
                                } else {
                                    if($estado==2){
                                        ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert" align="center">
                                              O email ja está associado a uma conta!
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            } else{
                                if($estado==3){
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert" align="center">
                                              Ocorreu um erro tente novamente! ou o email ja existe!
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            } else{
                                if($estado==4){
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert" align="center">
                                              A senha não está igual!
                                            </div>
                                        </div>
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
                        	<h3>Registo</h3>
                            <div class="form-group">
                                <label>Nome<span class="required">*</span></label>
                                 <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Username<span class="required">*</span></label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email<span class="required">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Senha<span class="required">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Repetir Senha<span class="required">*</span></label>
                                <input type="password" name="passwordR" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" required>
                                <a href="PoliticaEPrivacidade.php"><label > Política de Privacidade</label><br></a>
                            </div>
                            <button type="submit" name="botao" class="btn btn-primary btn-lg btn-block">Registrar</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>