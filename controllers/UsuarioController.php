<?php

namespace Controller;

use Model\Cliente;
use MVC\Router;

class UsuarioController{
    public static function index(Router $router){
        $cliente = new Cliente();
        $cliente->crear();

        $router->render('admin/index',[]);
    }
    public static function crear(Router $router){

    }
    public static function actualizar(Router $router){

    }
    public static function eliminar(){}
}