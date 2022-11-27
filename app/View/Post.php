<?php

namespace App\View;

use App\Entity\CommentEntity;
use App\Model\Comment;
use App\Model\Post;
use App\Entity\PostEntity;
use App\Utils\Session;

$post_id = $params['id'];

if (!isset($post_id)) {
    header('Location: /');
}

$post = Post::getPost($post_id);
$comments = Comment::getCommentsBy('post_id', $post_id);

if ($post === null) {
    echo "Post not found"; die;
}

function generate_comment(CommentEntity $comment, PostEntity $post, int $deepness)
{
    $comments_of_comment = $comment->getComments();

    if ((null !== Session::get() && (Session::get()->admin() == 1 || Session::get()->getId() == $comment->getUserId()))) {
        $edit_link = '<a href="/posts/' . $post->getId() . '/comments/' . $comment->getId() . '/edit" class="text-sm font-medium text-blue-600 hover:underline">Edit</a>';
        $delete_link = '<form action="/posts/' . $post->getId() . '/comments/' . $comment->getId() . '/delete" method="post" class="contents">
            <input type="submit" value="Delete" class="text-sm font-medium text-red-600 hover:underline cursor-pointer">
        </form>';
    } else {
        $edit_link = '';
        $delete_link = '';
    }

    if (count($comments_of_comment) > 0) {
        $comments_of_comment_html = '<div class="mt-' . ($deepness * 2) . ' flex flex-col gap-4">';
        foreach ($comments_of_comment as $comment_of_comment) {
            $comments_of_comment_html .= generate_comment($comment_of_comment, $post, $deepness + 1);
        }
        $comments_of_comment_html .= '</div>';
    } else {
        $comments_of_comment_html = '';
    }

    if (null !== Session::get()) {
        $new_comment_form = '<form action="/posts/' . $post->getId() . '/comments/' . $comment->getId() . '/comments" method="post" id="new-comment-' . $comment->getId() . '" class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <label>Comment</label>
                <textarea name="content" form="new-comment-' . $comment->getId() . '" placeholder="Content" class="border border-slate-300 rounded-lg p-2" required></textarea>
            </div>
            <div class="flex flex-col gap-2">
                <input type="submit" name="submit" value="Submit" class="bg-blue-500 text-white rounded-lg p-2 cursor-pointer hover:bg-blue-600">
            </div>
        </form>';
    } else {
        $new_comment_form = '<div class="text-red-500">You must be logged in to comment</div>';
    }

    return <<<HTML
        <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <span class="font-light text-gray-600">{$comment->getCreatedAt()}</span>
                <span class="font-light text-gray-600">{$comment->getUser()->getUsername()}</span>
                <div class="flex gap-2">
                    {$edit_link}
                    {$delete_link}
                </div>
            </div>
            <div class="mt-2">
                <p class="mt-2 text-gray-600">{$comment->getContent()}</p>
            </div>
            {$comments_of_comment_html}
            {$new_comment_form}
        </article>
    HTML;
}

?>

<article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600"><?= $post->getCreatedAt() ?></span>
        <span class="font-light text-gray-600"><?= $post->getUser()->getUsername() ?></span>
        <div class="flex gap-2">
            <?php if (null !== Session::get() && (Session::get()->admin() == 1 || Session::get()->getId() == $post->getUserId())) : ?>
                <a href="/posts/<?= $post->getId() ?>/edit" class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                <form action="/posts/<?= $post->getId() ?>/delete" method="post" class="contents">
                    <input type="submit" value="Delete" class="text-sm font-medium text-red-600 hover:underline cursor-pointer">
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-2">
        <a href="/posts/<?= $post->getId() ?>" class="text-2xl text-gray-700 font-bold hover:underline"><?= $post->getTitle() ?></a>
        <p class="mt-2 text-gray-600"><?= nl2br($post->getContent()) ?></p>
    </div>
    <?php if ($post->getImage() !== '') : ?>
        <img src="data:image/jpeg;base64,<?= base64_encode($post->getImage()) ?>" class="w-full mt-4">
    <?php endif; ?>
</article>

<section class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl">Comments</h1>
    <form action="/posts/<?= $post->getId() ?>/comments" method="post" id="new-comment" class="flex flex-col gap-4">
        <?php if (null === Session::get()) : ?>
            <div class="text-red-500">You must be logged in to comment</div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="text-red-500"><?= $error ?></div>
        <?php endif; ?>
        <div class="flex flex-col gap-2">
            <label>Comment</label>
            <textarea name="content" form="new-comment" placeholder="Content" class="border border-slate-300 rounded-lg p-2" required></textarea>
        </div>
        <div class="flex flex-col gap-2">
            <input type="submit" name="submit" value="Submit" class="bg-blue-500 text-white rounded-lg p-2 cursor-pointer hover:bg-blue-600" <?php if (null === Session::get()) echo 'disabled' ?>>
        </div>
    </form>
    <div class="mt-2 flex flex-col gap-4">
        <?php foreach ($comments as $comment) : ?>
            <?php if (null === $comment->getCommentParentId()) : ?>
                <?= generate_comment($comment, $post, 1) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>