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
