<?php
namespace Wskz\Views;

class IndexView implements IView
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

            <h1>Hello, <?=$data['login']?>!</h1>

            <h2>Here is your data:</h2>

            <dl>
                <dt>First Name:</dt>
                <dd><?= $data['first_name'] ?></dd>
                <dt>Last Name:</dt>
                <dd><?= $data['last_name'] ?></dd>
                <dt>Gender:</dt>
                <dd><?= $data['gender'] ?></dd>
            </dl>

            <p>You have been registered with us since <strong><?= $data['created_at']->format('d F Y') ?></strong>!</p>

        </main>

        <div id="shouts">
            <h2>Shoutbox</h2>
            <ul class="shouts">

            </ul>
            <label for="shout_area">Shout Body</label>
            <textarea name="shout"
                      id="shout_area"
                      cols="30"
                      rows="3"
                      placeholder="Your message here"
                      maxlength="255"></textarea>
            <button id="send_shout">Send</button>
        </div>

        <script src="assets/js/dist/shouts.min.js"></script>

        </body>
        </html>

        <?php
    }
}
