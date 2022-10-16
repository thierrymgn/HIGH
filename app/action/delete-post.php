<?php
require_once './../utils/pdo.php';

session_start();

if (!isset($_SESSION['username']) && (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1)) {
    header('Location: /');
}

$pdo = createPDO();

$request = $pdo->prepare("DELETE FROM `posts` WHERE `post_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
$request->execute([
    'id' => $_GET['id'],
    'user_id' => $_SESSION['userId'],
    'isAdmin' => $_SESSION['isAdmin']
]);

header('Location: /');
