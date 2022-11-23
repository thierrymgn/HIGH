<?php

namespace App\Entity;

class UserEntity
{
    private int $_id;
    private string $_username;
    private string $_password;
    private bool $_admin;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->{"_$key"} = $value;
        }
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getUsername(): string
    {
        return $this->_username;
    }

    public function getPassword(): string
    {
        return $this->_password;
    }

    public function admin(): bool
    {
        return $this->_admin;
    }
}
