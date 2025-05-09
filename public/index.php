<?php
include_once __DIR__.'/../includes/app.php';

use Controller\UsuarioController;
use MVC\Router;



$router = new Router();

$router->get('/admin/usuarios',[UsuarioController::class,'index']);

$router->get('/admin/crear',[UsuarioController::class,'crear']);
$router->post('/admin/crear',[UsuarioController::class,'crear']);

$router->get('/admin/actualizar',[UsuarioController::class,'actualizar']);
$router->post('/admin/actualizar',[UsuarioController::class,'actualizar']);

$router->post('/admin/eliminar',[UsuarioController::class,'eliminar']);


$router->comprobarRutas();