<?php


class UserModel
{
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Método para obter todos os produtos
    public function getAllUser()
    {
        $query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para obter um produto específico pelo ID
    public function getUserById($id)
    {
        
    }

    public function getUserByEmail($email)
    {
        require_once 'config/conect.php';

        $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getUserBySession()
    {
        require_once 'config/conect.php';
        $sql_User = "SELECT * FROM User WHERE email = :email";
        $stmt = $conn->prepare($sql_User);
        $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        $stmt->execute();

        $reg_User = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reg_User;
    }

    public function validadeByPassword($pass, $user){

        if (password_verify($pass, $user['password'])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            return true;
            exit();

        } else {
            return false;
            exit();
        } 
    }

    

}