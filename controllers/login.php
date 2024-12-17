<?php
session_start();
require('conect.php');
if(isset($_SESSION['email'])){
    header('location:index.html');
}

if(isset($_POST['botao'])){
                            $estado=0;
                            $pass=md5($_POST['password']);
                            $email=($_POST['email']);
                            $sql_code = "SELECT * FROM User WHERE email = '$email' AND password = '$pass'";
                            $query = mysqli_query($conn, $sql_code);
                            $quant = $query->num_rows;

                            if ($quant == 1) {

                                $user = $query->fetch_assoc();

                                if (!isset($_SESSION)) {
                                    session_start();
                                }

                                $_SESSION["id"] = $user["id"];
                                $_SESSION["email"] = $user["email"];
                                
                              } 
}
?>
