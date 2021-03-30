<?php

namespace Wskz\Controllers;
use Wskz\Repositories\UserRepository;


class IndexController implements IController
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
            echo '<pre>'.var_export($user, true).'</pre>';
        }
        echo '<pre>'.var_export($_SESSION, true).'</pre>';
    }

    public function post(): void
    {
        // TODO: Implement post() method.
    }
}
