<?php

class User {
    static function find($username) {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $request->execute([
            'username' => $username,
        ]);
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        return $users[0];
    }

    static function create($username, $password): int
    {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT COUNT(*) FROM users");
        $request->execute();
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        $userCount = $users[0]['COUNT(*)'];
        $request = $pdo->prepare("INSERT INTO `users` (`username`, `password`, `admin`) VALUES (:username, :password, :admin)");
        $request->execute([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'admin' => $userCount == 0 ? 1 : 0
        ]);
        return $pdo->lastInsertId();
    }

    static function login($username, $password) {
        $user = User::find($username);
        if (!empty($user)) {
            $hashedPassword = $user["password"];
            if (password_verify($password, $hashedPassword)) {
                return $user;
            }
        }
        return null;
    }
}
