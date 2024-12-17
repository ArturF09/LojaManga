<?php 

$servidor = 'sql303.infinityfree.com';      
$usuario = 'if0_37806647';       
$senha = 'SimbaChloe10 ';  
$banco_de_dados = 'if0_37806647_onemanga';  


$conn = mysqli_connect($servidor, $usuario, $senha, $banco_de_dados);

if (!$conn) {
    die('ERRO DE LIGAÇÃO: ' . mysqli_connect_error());  
} else {
    echo 'Conexão realizada com sucesso';  
}

?>