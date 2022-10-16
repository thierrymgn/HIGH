<?php
session_start();

require_once './utils/pdo.php';

if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
}

$request = $pdo->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`user_id`");
$request->execute();
$posts = $request->fetchAll(PDO::FETCH_ASSOC);

$title = 'Home';
$view = '_index.php';

include_once './layout.php';
