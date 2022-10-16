<form id="edit-post" method="post" action="/action/edit-post.php" class="contents">
    <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center">
            <span class="font-light text-gray-600"><?= $post['created_at'] ?></span>
            <div>
                <input type="submit" name="submit" value="Save"
                       class="text-sm font-medium text-blue-600 hover:underline cursor-pointer">
            </div>
        </div>
        <div class="mt-2 flex flex-col gap-4">
            <!--        <a href="/post.php?id=-->
            <? //= $post['post_id'] ?><!--" class="text-2xl text-gray-700 font-bold hover:underline">-->
            <? //= $post['title'] ?><!--</a>-->
            <!--        <p class="mt-2 text-gray-600">--><? //= nl2br($post['content']) ?><!--</p>-->
            <input type="text" name="title" value="<?= $post['title'] ?>" class="border border-slate-300 rounded-lg p-2"
                   required>
            <textarea name="content" form="edit-post" placeholder="Content"
                      class="border border-slate-300 rounded-lg p-2" required><?= $post['content'] ?></textarea>
            <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
        </div>
    </article>
</form>
