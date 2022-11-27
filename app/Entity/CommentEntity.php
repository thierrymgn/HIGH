<?php

namespace App\Entity;

use App\Model\User;
use App\Model\Comment;

class CommentEntity
{
    private int $_id;
    private int $_user_id;
    private int $_post_id;
    private string $_content;
    private string $_created_at;
    private int|null $_comment_parent_id = null;

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

    public function getPostId(): int
    {
        return $this->_post_id;
    }

    public function getContent(): string
    {
        return $this->_content;
    }

    public function getCreatedAt(): string
    {
        return $this->_created_at;
    }

    public function getCommentParentId(): int|null
    {
        return $this->_comment_parent_id;
    }

    public function getCommentParent(): CommentEntity
    {
        return Comment::getComment($this->_comment_parent_id);
    }

    public function getComments(): array
    {
        return Comment::getCommentsBy('comment_parent_id', $this->_id);
    }
}
