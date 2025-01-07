<?php


// Define as rotas para os produtos
$routes = [
    '/' => 'indexController',  // Página inicial
    '/loginController' => 'loginController@index', // Mostra o Login
    '/loginController/login' => 'loginController@login', // Faz o Login
    '/principalController' => 'principalController@index' // Mostra a Página principal

];

// Função para processar as rotas
function route($url) {
    global $routes;

    if (array_key_exists($url, $routes)) {
        [$controller, $method] = explode('@', $routes[$url]);

        // Incluir o controlador
        require_once "controllers/$controller.php";

        // Instanciar o controlador e chamar o método apropriado
        $controllerInstance = new $controller();
        $controllerInstance->$method();
    } else {
        http_response_code(404);
        echo "404 - Página não encontrada.";
    }
}
