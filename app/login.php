<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: /');
}

require_once './utils/pdo.php';

$error = "";
if (count($_POST) > 0) {
    $isSuccess = 0;

    $request = $pdo->prepare("SELECT * FROM users WHERE username=:username");
    $request->execute([
        'username' => $_POST['username'],
    ]);
    $users = $request->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        if (!empty($user)) {
            $hashedPassword = $user["password"];
            if (password_verify($_POST["password"], $hashedPassword)) {
                $isSuccess = 1;

                $_SESSION["username"] = $_POST["username"];
                $_SESSION["isAdmin"] = $user["admin"];
                $_SESSION["userId"] = $user["user_id"];
            }
        }
    }

    if ($isSuccess == 0) {
        $error = "Invalid Username or Password!";
        session_destroy();
    } else {
        header("Location:  /");
    }
}

$title = 'Login';
$view = '_login.php';
$show_header = false;

include_once './layout.php';
