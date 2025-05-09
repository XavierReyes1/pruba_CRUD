<?php

namespace Controller;

use Model\Cliente;
use MVC\Router;

class UsuarioController{
    public static function index(Router $router){
        $clientes = new Cliente();
        $clientes = Cliente::all();


        $router->render('admin/index',[
            'clientes'=>$clientes
        ]);
    }
    public static function crear(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cliente = new Cliente($_POST);

            $cliente->guardar();
         $router->render('admin/crear',[
            
        ]);
    }
    }
    public static function actualizar(Router $router){
        $id = $_GET['id'];
        $cliente = Cliente::buscarId($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cliente = new Cliente($_POST);
            $cliente->sincronizar();
            $cliente->guardar();
        }
    $router->render('admin/actualizar',[
        'cliente'=>$cliente
        ]);
    }
    public static function eliminar(){}
}