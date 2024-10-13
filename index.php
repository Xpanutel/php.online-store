<?php

require_once 'config/database.php'; 

// Массив маршрутов с регулярными выражениями
$routes = [
    '#^/register/?$#' => 'app/controllers/UserController.php',
    '#^/login/?$#' => 'app/controllers/UserController.php',
    // ... другие маршруты
];

// Получаем URI без GET параметров
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Функция логирования (для отладки)
function consoleLog($message) {
    echo "<script>console.log('" . json_encode($message) . "');</script>";
}

consoleLog("Запрос: " . $requestUri);

// Поиск совпадения маршрута
$matchedRoute = null;
foreach ($routes as $pattern => $controller) {
    if (preg_match($pattern, $requestUri, $matches)) {
        $matchedRoute = ['controller' => $controller, 'matches' => $matches];
        break;
    }
}

consoleLog("Маршрут: " . json_encode($matchedRoute));

if ($matchedRoute) {
    require_once $matchedRoute['controller'];
    $controllerName = basename($matchedRoute['controller'], '.php'); 
    $controller = new $controllerName($link); 

    // Вызов метода контроллера в зависимости от URI
    if (method_exists($controller, 'register') && $requestUri === '/register') {
        $controller->register();
    } elseif (method_exists($controller, 'login') && $requestUri === '/login') {
        $controller->login();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "Страница не найдена";
    }

} else {
    header('HTTP/1.0 404 Not Found');
    echo "Страница не найдена"; 
}

?>
