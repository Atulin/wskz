<?php
namespace Wskz\Controllers;
use Wskz\Views\LoginView;
use Wskz\Repositories\UserRepository;


class LoginController
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
        (new LoginView())->render([
            'errors' => $_SESSION['errors'] ?? null
        ]);
        unset($_SESSION['errors']);
    }

    public function post(): void
    {
        if ($id = $this->user_repo->login($_POST['login'], $_POST['password'])) {
            $_SESSION['uid'] = $id;
            header('Location: /');
        } else {
            $_SESSION['errors'][] = 'Invalid credentials';
            header('Location: /login');
        }
    }
}
