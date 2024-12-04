<?php
session_start();
require('conect.php');
if(isset($_SESSION['email'])){
    header('location:index.html');
}

if(isset($_POST['botao'])){
    $estado=0;
    $sql_verifica=sprintf("select * from User where email='%s';",$_POST['email']);
    $res_verifica=mysqli_query($conn,$sql_verifica);
    $num_verifica=mysqli_num_rows($res_verifica);
        
    if(!empty($_POST['nome']) and ($_POST['email']) and ($_POST['username']) and ($_POST['password'])){
        if($num_verifica==0){   
            $pass=md5($_POST['password']);
            $passR=md5($_POST['passwordR']);
        if($pass==$passR){
            $sql=sprintf("insert into User (nome, username, email, password) values ('%s', '%s', '%s', '%s');",$_POST['nome'],$_POST['username'],$_POST['email'],$pass);
            if(!mysqli_query($conn,$sql)){
                    
                $estado=2;
                } else {
                header('refresh:2;url=login.php');
            }
        } else {
            $estado=4;
            header('refresh:3;url=registrar.php');
        }
        } else {
        $estado=3;
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