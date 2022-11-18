<?php

class Comment
{
    static function find($id)
    {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT * FROM comments WHERE comment_id=:id");
        $request->execute([
            'id' => $id,
        ]);
        $comments = $request->fetchAll(PDO::FETCH_ASSOC);
        return $comments[0];
    }

    static function create($content, $userId, $postId): int
    {
        $pdo = createPDO();
        $request = $pdo->prepare("INSERT INTO `comments` (`content`, `user_id`, `post_id`) VALUES (:content, :user_id, :post_id)");
        $request->execute([
            'content' => $content,
            'user_id' => $userId,
            'post_id' => $postId
        ]);
        return $pdo->lastInsertId();
    }

    static function update($id, $content, $userId): void
    {
        $pdo = createPDO();
        $request = $pdo->prepare("UPDATE `comments` SET `content` = :content WHERE `comment_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
        $request->execute([
            'content' => $content,
            'id' => $id,
            'user_id' => $userId,
            'isAdmin' => $_SESSION['isAdmin']
        ]);
    }

    static function delete($id, $userId): void
    {
        $pdo = createPDO();
        $request = $pdo->prepare("DELETE FROM `comments` WHERE `comment_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
        $request->execute([
            'id' => $id,
            'user_id' => $userId,
            'isAdmin' => $_SESSION['isAdmin']
        ]);
    }

    public static function all(): bool|array
    {
        $pdo = createPDO();
        $request = $pdo->prepare("SELECT * FROM comments");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}
