<?php

namespace App\Framework\Exceptions;

use Exception;

class ViewNotFoundException extends Exception
{
    public function __construct(public readonly string $view_name)
    {
        parent::__construct("View $view_name not found");
    }
}