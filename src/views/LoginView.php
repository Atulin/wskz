<?php
namespace Wskz\Views;

class LoginView implements IView
{
    public function render(array $data): void
    {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
            <link rel="stylesheet" href="assets/css/dist/style.min.css">

            <title>Log In</title>
        </head>
        <body>

        <?php require 'shared/Navbar.php'?>

        <main>
            <?php if (isset($data['errors']) && !empty($data['errors'])): ?>
                <ul class="errors">
                    <?php foreach ($data['errors'] as $error): ?>
                        <li class="error"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="post">
                <label for="login">Login</label>
                <input id="login"
                       type="text"
                       placeholder="Login"
                       name="login">

                <label for="password">Password</label>
                <input id="password"
                       type="password"
                       placeholder="Password"
                       name="password">

                <input type="submit" value="Log in">
            </form>
        </main>

        </body>
        </html>

        <?php
    }
}
