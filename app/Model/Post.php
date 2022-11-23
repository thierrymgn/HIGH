<?php

namespace App\Model;

use App\Entity\PostEntity;
use App\Framework\Manager;

class Post
{
    private static ?Manager $_manager = null;

    public static function getPosts(): array
    {
        return self::getManager()->getAll();
    }

    public static function getPost(int $id): PostEntity | null
    {
        return self::getManager()->getById($id);
    }

    public static function createPost(PostEntity $post): PostEntity
    {
        return self::getManager()->create([
            'user_id' => $post->getUserId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
    }

    public static function updatePost(int $id, PostEntity $post): PostEntity
    {
        return self::getManager()->update($id, [
            'user_id' => $post->getUserId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
    }

    public static function deletePost(int $id): void
    {
        self::getManager()->delete($id);
    }

    private static function getManager(): Manager
    {
        if (self::$_manager === null) {
            self::$_manager = new Manager('posts', PostEntity::class);
        }
        return self::$_manager;
    }
}
