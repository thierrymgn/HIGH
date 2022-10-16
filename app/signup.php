<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: /');
}

require_once './utils/pdo.php';

$error = "";
if (count($_POST) > 0) {
    $isSuccess = 0;

    if ($_POST['password'] != $_POST['confirm-password']) {
        $error = "Password and Confirm Password do not match!";
    } else {
        $pdo = createPDO();

        $request = $pdo->prepare("SELECT COUNT(*) FROM users");
        $request->execute();
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        $userCount = $users[0]['COUNT(*)'];

        $request = $pdo->prepare("INSERT INTO `users` (`username`, `password`, `admin`) VALUES (:username, :password, :admin)");
        $request->execute([
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'admin' => $userCount == 0 ? 1 : 0
        ]);

        header("Location:  /");
    }
}

$title = 'Signup';
$view = '_signup.php';

include_once './layout.php';
