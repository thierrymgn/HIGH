<?php

namespace App\Entity;

use App\Model\User;
use App\Model\Comment;

class PostEntity
{
    private int $_id;
    private int $_user_id;
    private string $_title;
    private string $_content;
    private string $_created_at;

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

    public function getUserId(): int
    {
        return $this->_user_id;
    }

    public function getUser(): UserEntity
    {
        return User::getUser($this->_user_id);
    }

    public function getTitle(): string
    {
        return $this->_title;
    }

    public function getContent(): string
    {
        return $this->_content;
    }

    public function getCreatedAt(): string
    {
        return $this->_created_at;
    }

    public function getComments(): array
    {
        return Comment::getCommentsBy('post_id', $this->_id);
    }
}
