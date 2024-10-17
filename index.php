<?php
session_start();
require_once 'config/database.php'; 

// Массив маршрутов с регулярными выражениями
$routes = [
    '#^/register/?$#' => ['controller' => 'UserController', 'action' => 'register'],
    '#^/login/?$#' => ['controller' => 'UserController', 'action' => 'login'],
    '#^/admin/?$#' => ['controller' => 'AdminController', 'action' => 'index'],
    '#^/admin/add/?$#' => ['controller' => 'AdminController', 'action' => 'addAdminForm'],
    '#^/admin/add$#' => ['controller' => 'AdminController', 'action' => 'addAdmin'], 
    '#^/admin/delete/?$#' => ['controller' => 'AdminController', 'action' => 'deleteAdminForm'],
    '#^/admin/delete$#' => ['controller' => 'AdminController', 'action' => 'deleteAdmin'], 
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
            $controller->$actionName(); 
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Метод не найден";
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "Контроллер не найден";
    }

} else {
    header('HTTP/1.0 404 Not Found');
    echo "Страница не найдена"; 
}
?>
