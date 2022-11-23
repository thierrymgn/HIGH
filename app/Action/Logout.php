<?php

namespace App\Action;

session_destroy();

header('Location: /login');
