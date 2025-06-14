<?php
include_once __DIR__ . '/../includes/app.php';

use Controller\ClientesController;
use Controller\LoginController;
use Controller\ApiController;
use MVC\Router;

$router = new Router();

// Rutas de login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Rutas web de clientes (solo vistas)
$router->get('/admin/index', [ClientesController::class, 'index']);
$router->get('/admin/usuarios', [ClientesController::class, 'index']);
$router->get('/admin/crear', [ClientesController::class, 'crear']);
$router->get('/admin/actualizar', [ClientesController::class, 'actualizar']);

// Rutas API
$router->get('/api/clientes', [ApiController::class, 'listar']);
$router->get('/api/cliente', [ApiController::class, 'mostrar']);
$router->post('/api/crear-cliente', [ApiController::class, 'crear']);
$router->put('/api/actualizar-cliente', [ApiController::class, 'actualizar']);
$router->delete('/api/eliminar-cliente', [ApiController::class, 'eliminar']);



// Ruta de login para API
$router->post('/api/login', [LoginController::class, 'login']);
$router->comprobarRutas();
