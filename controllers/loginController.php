<?php
include 'response.php';

class loginController{

    public function index(){
        include 'includes/header.php';
        include 'views/loginView.php';
        include 'includes/footer.php';
        
    }
    public function login(){
        

        if (isset($_POST['botao'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
        
            // Preparando a consulta SQL com PDO
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);
        
            // Verifica se encontrou algum usuário
            if ($user) {
        
                // Verifica se a senha fornecida é igual à senha armazenada
                $valido = $userModel->validadeByPassword($pass, $user);

                if($valido == true){
                    Response::redirect('principalController/'); 
                    exit();
                }
                else { 
                        echo "Senha incorreta.";
                        include '../includes/header.php';
                        include '../view/loginView.php';
                        include '../includes/footer.php';
                    }

            } else {
                echo "Usuário não encontrado.";
                include '../includes/header.php';
                include '../view/loginView.php';
                include '../includes/footer.php';
            }
        }
        
    }
}

?>