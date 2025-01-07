<?php


class loginController{

    public function index(){
        include '../includes/header.php';
        include '../view/loginView.php';
        include '../includes/footer.php';
        
    }
    public function login(){
        require_once 'config/conect.php';

        if (isset($_POST['botao'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
        
            // Preparando a consulta SQL com PDO
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);
        
            // Verifica se encontrou algum usuário
            if ($user) {
        
                // Verifica se a senha fornecida é igual à senha armazenada
                $validade = $userModel->validadeByPassword($pass, $user);

                if($validade == true){
                    header('location:../views/PrincipalView.php'); 
                }
                else { 
                        echo "Senha incorreta.";
                    }

            } else {
                echo "Usuário não encontrado.";
            }
        }
        
    }
}




if (isset($_POST['botao'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Preparando a consulta SQL com PDO
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Verifica se encontrou algum usuário
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se a senha fornecida é igual à senha armazenada
        if (password_verify($pass, $user['password'])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            header('location:../views/Principal.php');
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>