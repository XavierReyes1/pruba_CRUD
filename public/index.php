<?php
include_once __DIR__.'/../includes/app.php';

use Controller\ClientesController;

use Controller\LoginController;
use MVC\Router;


$router = new Router();


// Rutas de login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/admin/index',[ClientesController::class,'index']);

$router->get('/admin/crear',[ClientesController::class,'crear']);
$router->post('/admin/crear',[ClientesController::class,'crear']);

$router->get('/admin/actualizar',[ClientesController::class,'actualizar']);
$router->post('/admin/actualizar',[ClientesController::class,'actualizar']);

$router->post('/admin/eliminar',[ClientesController::class,'eliminar']);


$router->comprobarRutas();