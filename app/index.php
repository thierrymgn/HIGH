<?php
session_start();

require_once './utils/pdo.php';
require './controllers/PostController.php';

PostController::index();
