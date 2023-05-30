<?php

declare(strict_types = 1);

use App\ { App, Config, Router };
use App\Controllers\{ HomeController, TransactionsController };

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

const STORAGE_PATH = __DIR__ . '/../storage';
const VIEW_PATH = __DIR__ . '/../views';

/*
*/
$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/', [HomeController::class, 'upload'])
    ->get('/transactions', [TransactionsController::class, 'index']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
