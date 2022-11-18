<?php
session_start();

require_once './utils/pdo.php';

PostController::update($_POST['id'], $_POST['title'], $_POST['content']);
