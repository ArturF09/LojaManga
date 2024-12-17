<?php

error_reporting(E_ALL);

session_start();
require('conect.php');  // Certifique-se de que 'conect.php' já esteja configurado para PDO

if (isset($_SESSION['email'])) {
    header('location:index.html');
    exit();  // Sempre use exit após redirecionamentos
}

if (isset($_POST['botao'])) {
    $estado = 0;
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta preparada para selecionar o usuário com o email fornecido
    $sql_code = "SELECT * FROM User WHERE email = :email";
    $stmt = $conn->prepare($sql_code);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Verifica se o usuário existe
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se a senha fornecida corresponde à senha armazenada (usando password_verify)
        if (password_verify($password, $user['password'])) {
            // Inicia sessão e define as variáveis de sessão
            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];

            header('location:index.html');  // Redireciona após o login bem-sucedido
            exit();
        } else {
            $estado = 1;  // Senha incorreta
        }
    } else {
        $estado = 2;  // Usuário não encontrado
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
         
        <div class="container" >
        	<div class="row">
            	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                	<div class="login-form-wrapper" style="border: 4px solid #986cec; border-radius: 15px; box-shadow: 0 5px 5px rgba(0,0,0,0.5);">
                        <form method="post" >
                        	<h3>Log In</h3>
                            <div class="form-group">
                                <label>Email<span class="required">*</span></label>
                                <input type="email" name="email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Senha<span class="required">*</span></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $reg_verifica['id'] ?>">
                            <button type="submit" name="botao" class="btn btn-primary btn-lg btn-block">Log in</button>
                            <br>
                                <center>
                                <div class="row">
                                    <div class="form-group col-sm-12" >
                                        <a href="ForgotPass.php" ><label style="color: #986cec; cursor: pointer;">Esqueceu sua senha?</label></a>
                                    </div>
                                    
                                    <div class="form-group col-sm-12">
                                        <label>Não tem uma conta?</label><a href="signup.php"><label style="color: #986cec; cursor: pointer;" > Registre-se aqui!</label></a>
                                    </div>
                                    
                                </div>
                                </center>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>