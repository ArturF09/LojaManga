<?php
session_start();
require('../config/conect.php');

if (isset($_SESSION['email'])) {
    header('location:../views/Principal.php');
    exit();
}

// Define as rotas para os produtos
$routes = [
    '/' => 'indexController',  // Página inicial
    '/loginController' => 'loginController@index' // Mostra o Login

];

// Obtém a URL da requisição
$requestUri = $_SERVER['REQUEST_URI'];

// Itera sobre as rotas e encontra a que corresponde
foreach ($routes as $route => $action) {
    // Ajusta a rota para lidar com parâmetros na URL
    $pattern = preg_replace('/\{(.*?)\}/', '([^/]+)', $route);
    if (preg_match('#^' . $pattern . '$#', $requestUri, $matches)) {
        array_shift($matches); // Remove o primeiro item (o caminho)

        // Separa o controlador e o método
        list($controller, $method) = explode('@', $action);

        // Inclui o controlador
        require_once "../controllers/{$controller}.php";

        // Instancia o controlador e chama o método
        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $method], $matches);
        exit;
    }
}