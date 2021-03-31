<?php

namespace Wskz\Controllers;

use Wskz\Views\IndexView;
use Wskz\Views\IndexEmptyView;
use Wskz\Repositories\UserRepository;


class IndexController
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
        if (isset($_SESSION['uid'])) {
            $user = $this->user_repo->getById($_SESSION['uid']);

            if (!$user) {
                die('Unauthorized');
            }

            $data = [
                'messages' => $_SESSION['messages'] ?? null,
                'login' => $user->getLogin(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'gender' => $user->getGender(),
                'created_at' => $user->getCreatedAt(),
            ];
            (new IndexView())->render($data);
        } else {
            $data = [
                'messages' => $_SESSION['messages'] ?? null,
            ];
            (new IndexEmptyView())->render($data);
        }
        unset($_SESSION['messages']);
    }
}
