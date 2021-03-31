<?php

namespace Wskz\Controllers;
use JsonException;
use Wskz\Models\ShoutModel;
use Wskz\Repositories\ShoutsRepository;


class ShoutsController
{
    private ShoutsRepository $shouts_repo;

    /**
     * ShoutsController constructor.
     */
    public function __construct()
    {
        $this->shouts_repo = new ShoutsRepository();
    }

    public function get(): void
    {
        if (!isset($_SESSION['uid'])) {
            die ('Unauthorized');
        }

        header('Content-Type: application/json');
        try {
            $shouts = $this->shouts_repo->getSome();
            echo json_encode($shouts, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            die('500 Server Error');
        }
    }

    public function post()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['uid'])) {
            die ('Unauthorized');
        }

        try {
            $data = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

            if (strlen($data['body']) > 255) {
                echo json_encode(['error' => 'Message too long, maximum is 255 characters'], JSON_THROW_ON_ERROR);
            }

            $shout = ShoutModel::builder()
                ->setBody($data['body'])
                ->setAuthor($_SESSION['uid']);
            $result = $this->shouts_repo->create($shout);

            echo json_encode($result, JSON_THROW_ON_ERROR);

        } catch (JsonException $e) {
            die('500 Server Error');
        }
    }
}
