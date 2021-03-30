<?php
use Wskz\Lib\Dotenv;
use Wskz\Controllers\IController;
use Wskz\Controllers\LoginController;
use Wskz\Controllers\IndexController;
use Wskz\Controllers\RegisterController;

session_start();

require __DIR__ . '/vendor/autoload.php';

(new Dotenv(__DIR__ . '/.env'))->load();

if (isset($_ENV['ENV']) && $_ENV['ENV'] === 'DEV') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

$url = parse_url($_SERVER['REQUEST_URI']);

/** @var IController $controller */
$controller = null;
switch ($url['path']) {
    case '/':
        $controller = new IndexController();
        break;
    case '/login':
        $controller = new LoginController();
        break;
    case '/register':
        $controller = new RegisterController();
        break;
    default:
        die('404 Not Found');
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->post();
        break;
    case 'GET':
        $controller->get();
        break;
    default:
        die('404 Not Fond');
}
