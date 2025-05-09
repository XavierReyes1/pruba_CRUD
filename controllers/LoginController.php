<?php

namespace Controller;


use MVC\Router;
use Model\Usuario;

class LoginController
{


    public static function login(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
   
            if (empty($alertas)) {
                $usuario = Usuario::buscar('email', $usuario->email);
                    
                if (!$usuario) {
                    Usuario::setAlerta('error', 'El usuario no existe');
                } 
               
                    if ($_POST['password'] === $usuario->password) {
                       
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionar
                        header('Location: /admin/usuarios');
                        exit;
                    } else {
                        Usuario::setAlerta('error', 'La contraseña es incorrecta');
                    }
                
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('login/login', [
            'usuario' => $usuario ?? new Usuario(),
            'alertas' => $alertas
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /login');
    }
}
