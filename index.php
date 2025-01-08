<?php
session_start();
require('config/conect.php');



// Carregar o sistema de rotas
require_once 'routes/web.php';


if (isset($_SESSION['email'])) {
    route('controller/principalController.php');
    exit();
}
// Capturar a URL solicitada
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Processar a rota
route($url);

?>