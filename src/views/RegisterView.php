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

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
            <link rel="stylesheet" href="assets/css/dist/style.min.css">

            <title>Register</title>
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
                       name="login"
                       type="text"
                       placeholder="Login"
                       required
                       minlength="6"
                       pattern="[a-zA-Z0-9]{6,}">
                <span class="hint">At least 6 alphanumeric characters</span>

                <label for="first_name">First Name</label>
                <input id="first_name"
                       name="first_name"
                       type="text"
                       placeholder="First Name"
                       required>

                <label for="last_name">Last Name</label>
                <input id="last_name"
                       name="last_name"
                       type="text"
                       placeholder="Last Name"
                       required>

                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="" disabled selected hidden>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <label for="password">Password</label>
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="Password"
                       required
                       minlength="8">
                <span class="hint">At least 8 characters</span>

                <label for="password_2">Repeat Password</label>
                <input id="password_2"
                       name="password_2"
                       type="password"
                       placeholder="Password again"
                       required
                       minlength="8">

                <input type="submit" value="Register">
            </form>
        </main>

        </body>
        </html>

        <?php
    }
}
