<?php 

$servidor = 'sql303.infinityfree.com';      
$usuario = 'if0_37806647';       
$senha = 'SimbaChloe10';  
$banco_de_dados = 'if0_37806647_onemanga';

try {
    // Criando a conexão com PDO
    $conn = new PDO("mysql:host=$servidor;dbname=$banco_de_dados", $usuario, $senha);
    
    // Definindo o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Conexão realizada com sucesso';  
} catch (PDOException $e) {
    // Tratamento de erro caso a conexão falhe
    die('ERRO DE LIGAÇÃO: ' . $e->getMessage());
}

?>
