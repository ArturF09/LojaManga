<?php
session_start();
require('../config/conect.php');

if (isset($_SESSION['email'])) {
    header('location:../views/Principal.php');
    exit();
}

// Carregar o sistema de rotas
require_once 'routes.php';

// Capturar a URL solicitada
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Processar a rota
route($url);