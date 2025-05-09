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
                } else {

                    if (password_verify($_POST['password'], $usuario->password)) {

                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionar 
                        header('Location: /dashboard');
                    } else {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('login/login', [
            'usuario' =>  $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function logout() {}
}
