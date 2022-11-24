<?php

namespace App\View;

use App\Model\Comment;
use App\Model\Post;
use App\Utils\Session;

$post_id = $params['id'];

if (!isset($post_id)) {
    header('Location: /');
}

$post = Post::getPost($post_id);
$comments = Comment::getCommentsByPostId($post_id);

if ($post === null) {
    echo "Post not found"; die;
}

?>

<article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600"><?= $post->getCreatedAt() ?></span>
        <span class="font-light text-gray-600"><?= $post->getUser()->getUsername() ?></span>
        <div class="flex gap-2">
            <?php if (null !== Session::get() && (Session::get()->admin() == 1 || Session::get()->getId() == $post->getUserId())): ?>
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
</article>

<section class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl">Comments</h1>
    <form action="/posts/<?= $post->getId() ?>/comments" method="post" id="new-comment" class="flex flex-col gap-4">
        <?php if (null === Session::get()): ?>
            <div class="text-red-500">You must be logged in to comment</div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
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
        <?php foreach ($comments as $comment): ?>
            <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <span class="font-light text-gray-600"><?= $comment->getCreatedAt() ?></span>
                    <span class="font-light text-gray-600"><?= $comment->getUser()->getUsername() ?></span>
                    <div class="flex gap-2">
                        <?php if (null !== Session::get() && (Session::get()->admin() == 1 || Session::get()->getId() == $comment->getUserId())): ?>
                            <a href="/posts/<?= $post->getId() ?>/comments/<?= $comment->getId() ?>/edit" class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="/posts/<?= $post->getId() ?>/comments/<?= $comment->getId() ?>/delete" method="post" class="contents">
                                <input type="submit" value="Delete" class="text-sm font-medium text-red-600 hover:underline cursor-pointer">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="mt-2 text-gray-600"><?= nl2br($comment->getContent()) ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
