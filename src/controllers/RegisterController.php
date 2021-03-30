<?php
namespace Wskz\Controllers;
use Wskz\Models\UserModel;
use Wskz\Views\RegisterView;
use Wskz\Repositories\UserRepository;


class RegisterController implements IController
{
    private UserRepository $user_repo;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->user_repo = new UserRepository();
    }

    public function get(): void
    {
        (new RegisterView())->render([
            'errors' => $_SESSION['errors'] ?? null
        ]);
        unset($_SESSION['errors']);
    }

    public function post(): void
    {
        if ($this->user_repo->checkLoginExist($_POST['login'])) {
            $_SESSION['errors'][] = 'Login taken.';
        }

        if (count($_POST['login']) < 6) {
            $_SESSION['errors'][] = 'Login should be no shorter than 6 characters.';
        }

        if (!preg_match('/[a-zA-Z0-9]+/', $_POST['login'])) {
            $_SESSION['errors'][] = 'Login can only contain alphanumeric characters.';
        }

        if (count($_POST['password']) < 8) {
            $_SESSION['errors'][] = 'Password cannot be shorter than 8 characters.';
        }

        if ($_POST['password'] !== $_POST['password_2']) {
            $_SESSION['errors'][] = 'Passwords do not match.';
        }

        if (count($_SESSION['errors']) > 0) {
            header('Location: /register');
            die();
        }

        $user = UserModel::builder()
            ->setLogin($_POST['login'])
            ->setFirstName($_POST['first_name'])
            ->setLastName($_POST['last_name'])
            ->setGender($_POST['gender'])
            ->setPassword($_POST['password'])
        ;

        if ($this->user_repo->create($user)) {
            $_SESSION['messages'][] = 'Registration successful. You can log in now!';
            header('Location: /');
            die();
        }

        $_SESSION['errors'][] = 'An unknown error has occurred';
        header('Location: /register');
    }
}
