<?php

namespace App\Framework\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct(public readonly string $route_name)
    {
        parent::__construct("Route $route_name not found");
    }
}
