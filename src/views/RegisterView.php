<?php
namespace Wskz\Views;

class RegisterView implements IView
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
            <title>Register</title>
        </head>
        <body>

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
                <input id="login" name="login" type="text">

                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text">

                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text">

                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <label for="password">Password</label>
                <input id="password" name="password" type="password">

                <label for="password_2">Repeat Password</label>
                <input id="password_2" name="password_2" type="password">

                <input type="submit" value="Register">
            </form>
        </main>

        </body>
        </html>

        <?php
    }
}
