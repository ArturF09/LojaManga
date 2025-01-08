<?php

require_once 'response.php';
// Define as rotas para os produtos
$routes = [
    //'/LojaManga/' => 'indexController@index',  // Página inicial
    //'/loginController' => 'loginController@index', // Mostra o Login
    '/LojaManga/' => 'loginController@index',
    '/loginController/login' => 'loginController@login', // Faz o Login
    '/principalController' => 'principalController@index' // Mostra a Página principal

];

// Função para processar as rotas
function route($url) {
    global $routes;

    if (array_key_exists($url, $routes)) {
        [$controller, $method] = explode('@', $routes[$url]);

        // Incluir o controlador
        $controllerFile = "./controllers/$controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Verifica se a classe do controlador existe
            if (class_exists($controller)) {
                $controllerInstance = new $controller();

                // Verifica se o método do controlador existe
                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method();
                } else {
                    echo "Método $method não encontrado no controlador $controller.";
                }
            } else {
                echo "Controlador $controller não encontrado.";
            }
        } else {
            echo "Arquivo do controlador $controller.php não encontrado.";
        }
    } else {
        http_response_code(404);
        echo "404 - Página não encontrada.";
     
    }
}
