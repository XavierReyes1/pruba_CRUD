<?php
include_once __DIR__.'/../includes/app.php';

use Controller\UsuarioController;
use Controller\LoginController;
use MVC\Router;



$router = new Router();

// Rutas de login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/admin/usuarios',[UsuarioController::class,'index']);

$router->get('/admin/crear',[UsuarioController::class,'crear']);
$router->post('/admin/crear',[UsuarioController::class,'crear']);

$router->get('/admin/actualizar',[UsuarioController::class,'actualizar']);
$router->post('/admin/actualizar',[UsuarioController::class,'actualizar']);

$router->post('/admin/eliminar',[UsuarioController::class,'eliminar']);


$router->comprobarRutas();