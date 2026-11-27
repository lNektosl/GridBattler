<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\GameController;
use App\Services\GridService;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

/**
 * Define the routes for the application.
 */
$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'home']);
    $r->addRoute('GET', '/hello/{name}', ['App\Controllers\HelloController', 'greet']);
    $r->addRoute('GET', '/game', ['App\Controllers\GameController', 'index']);
    $r->addRoute('POST', '/game/start', ['App\Controllers\GameController', 'gameStart']);
    $r->addRoute('POST', '/api/commands', ['App\Controllers\GameController', 'processCommands']);
});

/**
 * Get the request method and URI from the server variables and invoke the dispatcher.
 */
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

/**
 * Switch on the dispatcher result and call the appropriate controller method if found.
 */
// TODO: add a proper HTML view for error states below

// Infrastructure
$eventBus = new App\Events\EventBus();

// Factories
$entityFactory = new App\Factory\EntityFactory($eventBus);

// Services
$gridService = new App\Services\GridService(
    $entityFactory
);

// Manager

$gameManager = new App\Managers\GameManager(
    $gridService, $entityFactory
);

// Controllers
$gameController = new App\Controllers\GameController(
    $gameManager
);

$controllers = [
    App\Controllers\GameController::class => $gameController,
];

switch ($routeInfo[0]) {
    // Handle not found routes
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo 'Not Found';
        break;
    // Handle routes that were invoked with the wrong HTTP method
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo 'Method Not Allowed';
        break;
    // Handle found routes
    case FastRoute\Dispatcher::FOUND:
        $class = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $grridServicee = new App\Services\GridService();
        $controller = $controllers[$class] ?? new $class();
        $vars = $routeInfo[2];
        $controller->$method($vars);
        break;
    default:
        http_response_code(500);
        echo 'Internal Server Error';
        break;
}
