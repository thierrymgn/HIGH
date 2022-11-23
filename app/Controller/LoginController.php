<?php

namespace App\Controller;

use App\Framework\BaseController;

class LoginController extends BaseController
{
    protected bool $_show_header = false;

    protected function getTitle(): string
    {
        return "Login";
    }
}