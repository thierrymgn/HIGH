<div class="w-screen h-screen flex flex-col justify-center items-center" style="max-width: -webkit-fill-available; max-height: -webkit-fill-available;">
    <h1 class="text-2xl">Signup</h1>
    <form name="form-user" method="post" action="" class="flex flex-col gap-4">
        <div class="text-red-500"><?= $error ?></div>

        <div class="flex flex-col gap-2">
            <label>Username</label>
            <input type="text" name="username" required class="border border-slate-300 rounded-lg p-2">
        </div>

        <div class="flex flex-col gap-2">
            <label>Password</label>
            <input type="password" name="password" required class="border border-slate-300 rounded-lg p-2">
        </div>

        <div class="flex flex-col gap-2">
            <label>Confirm Password</label>
            <input type="password" name="confirm-password" required class="border border-slate-300 rounded-lg p-2">
        </div>

        <div class="flex flex-col gap-2">
            <input type="submit" name="submit" value="Submit" class="bg-blue-500 text-white rounded-lg p-2 cursor-pointer hover:bg-blue-600">
        </div>

        <a href="/login.php" class="text-blue-500 hover:underline text-center">Login</a>
    </form>
</div>
