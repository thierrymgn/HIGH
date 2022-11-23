<?php

namespace App\Framework;

use App\Framework\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function __construct()
    {
        $stringRoute = file_get_contents(__DIR__ . '/../Config/routes.json');
        $this->routes = json_decode($stringRoute);
    }

    /**
     * @throws RouteNotFoundException
     */
    public function getRoute(string $url, string $method = 'GET'): Route
    {
        foreach ($this->routes as $route) {
            $regex = preg_replace('/:([a-zA-Z0-9]+)/', '(?<\1>[a-zA-Z0-9]+)', $route->path);
            $regex = str_replace('/', '\/', $regex);
            $regex = '/^' . $regex . '$/';

            if (preg_match($regex, $url, $matches) && $route->method === $method) {
                return new Route(
                    name: $route->name,
                    path: $route->path,
                    controller: $route->controller,
                    action: $route->action ?? null,
                    view: $route->view ?? null,
                    method: $route->method,
                    params: array_slice($matches, 1),
                );
            }
        }

        throw new RouteNotFoundException($url);
    }
}
