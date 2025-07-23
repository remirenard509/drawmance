<?php
require_once __DIR__ . '/../Controllers/AuthController.php';
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';
// Ajouter d'autres contrôleurs ici

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ("$method $uri") {
    case 'POST /register':
        (new AuthController())->register();
        break;

    case 'POST /login':
        (new AuthController())->login();
        break;

    case 'GET /logout':
        (new AuthController())->logout();
        break;

    case 'GET /dashboard':
        AuthMiddleware::check();
        require __DIR__ . '/../../public/dashboard.php';
        break;

    default:
        http_response_code(404);
        echo "404 - Route introuvable.";
        break;
}
