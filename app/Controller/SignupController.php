<?php

namespace App\Controller;

use App\Framework\BaseController;

class SignupController extends BaseController
{
    protected bool $_show_header = false;

    protected function getTitle(): string
    {
        return "Signup";
    }
}