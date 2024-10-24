<?php
session_start();
require_once 'config/database.php'; 

// Массив маршрутов с регулярными выражениями
$routes = [
    '#^/register/?$#' => ['controller' => 'UserController', 'action' => 'register'],
    '#^/login/?$#' => ['controller' => 'UserController', 'action' => 'login'],
    '#^/admin/?$#' => ['controller' => 'AdminController', 'action' => 'index'],
    '#^/admin/add/?$#' => ['controller' => 'AdminController', 'action' => 'addAdmin'],
    '#^/products/?$#' => ['controller' => 'ProductController', 'action' => 'index'], 
    '#^/product/add/?$#' => ['controller' => 'ProductController', 'action' => 'store'], 
    '#^/product/edit/(?P<id>\d+)$#' => ['controller' => 'ProductController', 'action' => 'update'], 
    '#^/product/delete/(?P<id>\d+)$#' => ['controller' => 'ProductController', 'action' => 'delete'], 
];

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Получаем URI без GET параметров
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Поиск совпадения маршрута
$matchedRoute = null;
foreach ($routes as $pattern => $route) {
    if (preg_match($pattern, $requestUri)) {
        $matchedRoute = $route;
        break;
    }
}

if ($matchedRoute) {
    $controllerName = $matchedRoute['controller'];
    $actionName = $matchedRoute['action'];
    $controllerPath = 'app/controllers/' . $controllerName . '.php'; 

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controller = new $controllerName($link); 

        if (method_exists($controller, $actionName)) {
            $params = [];
            // $controller->$actionName(); 
            if (preg_match($pattern, $requestUri, $matches)) {
                // Удаляем первый элемент массива (полное совпадение)
                array_shift($matches);
                $params = $matches; 
            }
    
            // Вызываем метод контроллера с параметрами
            call_user_func_array([$controller, $actionName], $params);
        } else {
            http_response_code(404);
            echo "Метод не найден";
        }
    } else {
        http_response_code(404);
        echo "Контроллер не найден";
    }

} else {
    http_response_code(404);
    echo "Страница не найдена"; 
}
?>
