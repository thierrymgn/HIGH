<?php

namespace App\Model;

use App\Entity\UserEntity;
use App\Framework\Manager;

class User
{
    private static ?Manager $_manager = null;

    public static function getUsers(): array
    {
        return self::getManager()->getAll();
    }

    public static function getUser(int $id): UserEntity
    {
        return self::getManager()->getById($id);
    }

    public static function getUsersByUsername(string $username): array
    {
        return self::getManager()->getBy('username', $username);
    }

    public static function createUser(UserEntity $user): UserEntity
    {
        return self::getManager()->create([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'admin' => $user->admin() ? 1 : 0,
        ]);
    }

    public static function updateUser(UserEntity $user): UserEntity
    {
        return self::getManager()->update($user->getId(), [
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'admin' => $user->admin() ? 1 : 0,
        ]);
    }

    public static function deleteUser(int $id): void
    {
        self::getManager()->delete($id);
    }

    private static function getManager(): Manager
    {
        if (self::$_manager === null) {
            self::$_manager = new Manager('users', UserEntity::class);
        }
        return self::$_manager;
    }
}
