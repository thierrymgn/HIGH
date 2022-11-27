<?php

namespace App\Model;

use App\Entity\CommentEntity;
use App\Entity\PostEntity;
use App\Framework\Manager;

class Comment
{
  private static ?Manager $_manager = null;

  public static function getComment(int $id): CommentEntity | null
  {
    return self::getManager()->getById($id);
  }

  public static function getCommentsBy(string $field, int $post_id): array
  {
    return self::getManager()->getBy($field, $post_id);
  }

  public static function createComment(CommentEntity $comment): CommentEntity
  {
    return self::getManager()->create([
      'user_id' => $comment->getUserId(),
      'post_id' => $comment->getPostId(),
      'content' => $comment->getContent(),
      'comment_parent_id' => $comment->getCommentParentId(),
    ]);
  }

  public static function updateComment(int $id, CommentEntity $comment): CommentEntity
  {
    return self::getManager()->update($id, [
      'content' => $comment->getContent(),
    ]);
  }

  public static function deleteComment(int $id): void
  {
    self::getManager()->delete($id);
  }

  private static function getManager(): Manager
  {
    if (self::$_manager === null) {
      self::$_manager = new Manager('comments', CommentEntity::class);
    }
    return self::$_manager;
  }
}
