<?php

require './controllers/AuthController.php';

AuthController::login();

//session_start();
//
//if (isset($_SESSION['username'])) {
//    header('Location: /');
//}
//
//require_once './utils/pdo.php';
//
//$error = "";
//
//
//$title = 'Login';
//$view = '_login.php';
//$show_header = false;
//
//include_once './layout.php';
