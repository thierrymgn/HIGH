<?php

class AuthController {
    static function login(): void
    {
        if (count($_POST) > 0) {
            $isSuccess = 0;

            $users = User::all();

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
        include_once './utils/layout.php';
    }

    static function signup(): void
    {
        $title = 'Signup';
        $view = '_signup.php';
        include_once './utils/layout.php';
    }

    static function logout(): void
    {
        session_destroy();
        header('Location: /');
    }
}