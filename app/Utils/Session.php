<?php

namespace App\Utils;

use App\Entity\UserEntity;

class Session
{
    public static function save(UserEntity $user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'admin' => $user->admin(),
        ];
    }

    public static function get(): ?UserEntity
    {
        if (isset($_SESSION['user'])) {
            return new UserEntity($_SESSION['user']);
        }
        return null;
    }
}
