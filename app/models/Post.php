<?php

class Post
{
    static function find($id)
    {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT * FROM posts WHERE post_id=:id");
        $request->execute([
            'id' => $id,
        ]);
        $posts = $request->fetchAll(PDO::FETCH_ASSOC);
        return $posts[0];
    }

    static function create($title, $content, $userId): int
    {
        $pdo = createPDO();
        $request = $pdo->prepare("INSERT INTO `posts` (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)");
        $request->execute([
            'title' => $title,
            'content' => $content,
            'user_id' => $userId
        ]);
        return $pdo->lastInsertId();
    }

    static function update($id, $title, $content, $userId): void
    {
        $pdo = createPDO();
        $request = $pdo->prepare("UPDATE `posts` SET `title` = :title, `content` = :content WHERE `post_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
        $request->execute([
            'title' => $title,
            'content' => $content,
            'id' => $id,
            'user_id' => $userId,
            'isAdmin' => $_SESSION['isAdmin']
        ]);
    }

    static function delete($id, $userId): void
    {
        $pdo = createPDO();
        $request = $pdo->prepare("DELETE FROM `posts` WHERE `post_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
        $request->execute([
            'id' => $id,
            'user_id' => $userId,
            'isAdmin' => $_SESSION['isAdmin']
        ]);
    }

    public static function all(): bool|array
    {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT * FROM posts");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}
