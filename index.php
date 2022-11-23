<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Framework\Exceptions\RouteNotFoundException;
use App\Framework\Exceptions\ViewNotFoundException;
use App\Framework\HttpRequest;
use App\Framework\Router;

session_start();

$httpRequest = new HttpRequest();
$router = new Router();

try {
    $route = $router->getRoute($httpRequest->getUrl(), $httpRequest->getMethod());
    $controller = $route->getController();
    $controller->view($route->getActionOrView());
} catch (RouteNotFoundException $e) {
} catch (ViewNotFoundException $e) {
    echo $e->getMessage();
}
