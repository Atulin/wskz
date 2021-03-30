<?php

namespace Wskz\Repositories;
use PDO;
use PDOException;


class BaseRepository
{
    protected PDO $pdo;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";
        $options = [
            PDO::ATTR_ERRMODE => $_ENV['ENV'] === 'DEV' ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
        } catch (PDOException $e) {
            throw $e;
        }
    }

}
