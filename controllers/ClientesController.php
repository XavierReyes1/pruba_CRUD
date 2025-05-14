<?php
namespace Controller;

use MVC\Router;

class ClientesController {
    public static function index(Router $router) {
        session_start();
        sesionActiva();
        
        $router->render('admin/index', [
            'clientes' => [],
            'alertas' => []
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        sesionActiva();
        
        $router->render('admin/crear', [
            'cliente' => new \Model\Cliente(),
            'alertas' => []
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        sesionActiva();
        
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