<?php
namespace Controller;

use MVC\Router;
use Classes\AuthMiddleware;

class ClientesController {
    public static function index(Router $router) {
     $datosUsuario = AuthMiddleware::proteger();
        
        $router->render('admin/index', [
            'clientes' => [],
            'alertas' => []
        ]);
    }

    public static function crear(Router $router) {
       $datosUsuario = AuthMiddleware::proteger();
        
        $router->render('admin/crear', [
            'cliente' => new \Model\Cliente(),
            'alertas' => []
        ]);
    }

    public static function actualizar(Router $router) {
      $datosUsuario = AuthMiddleware::proteger();
        
        $id = $_GET['id'] ?? null;
        $cliente = \Model\Cliente::buscar('id', $id);
        
        if (!$cliente) {
            header('Location: /admin/index');
            return;
        }
        
        $router->render('admin/actualizar', [
            'cliente' => $cliente,
            'alertas' => []
        ]);
    }
}