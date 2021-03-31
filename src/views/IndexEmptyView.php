<?php
namespace Wskz\Views;

class IndexEmptyView implements IView
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
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
            <link rel="stylesheet" href="assets/css/dist/style.min.css">

            <title>Company Site</title>
        </head>
        <body>

        <?php require 'shared/Navbar.php'?>

        <main>
            <?php if (isset($data['messages']) && !empty($data['messages'])): ?>
                <ul class="messages">
                    <?php foreach ($data['messages'] as $message): ?>
                        <li class="message"><?= $message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <h1>Hello, stranger!</h1>

            <p>If you want to partake in our very own and very private shoutbox, all you need to do
            is <a href="/register">register an account</a> or <a href="/login">log in</a> if you already have one!</p>

        </main>

        </body>
        </html>

        <?php
    }
}
