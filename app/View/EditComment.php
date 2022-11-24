<?php

namespace App\View;

use App\Model\Post;
use App\Model\Comment;
use App\Utils\Session;

if (null === Session::get() || null === Session::get()->getId()) {
    header('Location: /');
    exit;
}

$comment_id = $params['commentId'];

$post_id = $params['id'];

if (!isset($comment_id)) {
    header('Location: /');
}

$comment = Comment::getComment($comment_id);

$post = Post::getPost($post_id);

if ($comment === null) {
    echo "Comment not found";
    die;
}

?>

<form id="edit-comment" method="post" action="/posts/<?= $post->getId() ?>/comments/<?= $comment->getId() ?>/edit" class="contents">
    <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center">
            <span class="font-light text-gray-600"><?= $comment->getCreatedAt() ?></span>
            <div>
                <input type="submit" name="submit" value="Save" class="text-sm font-medium text-blue-600 hover:underline cursor-pointer">
            </div>
        </div>
        <div class="mt-2 flex flex-col gap-4">
            <textarea name="content" form="edit-comment" placeholder="Content" class="border border-slate-300 rounded-lg p-2" required><?= $comment->getContent() ?></textarea>
            <input type="hidden" name="id" value="<?= $comment->getId() ?>">
        </div>
    </article>
    <?php if (isset($error)) : ?>
        <div class="text-red-500"><?= $error ?></div>
    <?php endif; ?>
</form>