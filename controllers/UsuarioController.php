<?php

namespace Controller;

use Model\Cliente;
use MVC\Router;

class UsuarioController{
    public static function index(Router $router){
        $clientes = new Cliente();
        $clientes = Cliente::all();
        $alertas = [];

        $router->render('admin/index',[
            'clientes'=>$clientes,
            'alertas' => $alertas
        ]);
    }
    public static function crear(Router $router){
     $alertas = [];
    $cliente = new Cliente();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cliente = new Cliente($_POST);
        $alertas = $cliente->validar();

        if (empty($alertas['error'])) {
            $resultado = $cliente->guardar();
            if ($resultado) {
                Cliente::setAlerta('exito', 'Cliente creado correctamente');
            }
            header('Location: /admin/usuarios');
        }
        $alertas = Cliente::getAlertas();
    }

    $router->render('admin/crear', [
        'cliente' => $cliente,
        'alertas' => $alertas
    ]);
    
    }
    public static function actualizar(Router $router){
    $id = $_GET['id'];
    $cliente = Cliente::buscar('id', $id);
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cliente->sincronizar($_POST);
           $cliente->fecha_registro = date('Y/m/d');
        $alertas = $cliente->validar();

        if (empty($alertas['error'])) {
         
            $resultado = $cliente->guardar();
            
            if ($resultado) {
                Cliente::setAlerta('exito', 'Cliente actualizado correctamente');
                
            }
            header('Location: /admin/usuarios');
        }
        $alertas = Cliente::getAlertas();
    }

    $router->render('admin/actualizar', [
        'cliente' => $cliente,
        'alertas' => $alertas
    ]);
    }
    public static function eliminar(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario= Cliente::buscar('id',$_POST['id']);
            $usuario->eliminar();
                if($usuario){
                header('Location: /admin/usuarios');
            }
        }
    }
}