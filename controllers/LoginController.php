<?php
namespace Controller;

use MVC\Router;
use Model\Usuario;
use Classes\JWT;

class LoginController
{
    public static function login(Router $router) {
    $alertas = [];
    $usuario = new Usuario($_POST);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = new Usuario($_POST);
        $alertas = $usuario->validarLogin();

        if (empty($alertas)) {
            $usuario = Usuario::buscar('email', $usuario->email);
                
            if (!$usuario) {
                Usuario::setAlerta('error', 'El usuario no existe');
            } else {
                if ($_POST['password'] === $usuario->password) {
                    // Crear token JWT
                    $token = JWT::crearToken([
                        'id' => $usuario->id,
                        'email' => $usuario->email
                    ]);
                    
                    // Para API, devolver el token en la respuesta JSON
                    if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] === 'application/json') {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'token' => $token,
                            'usuario' => [
                                'id' => $usuario->id,
                                'email' => $usuario->email
                            ]
                        ]);
                        return;
                    }
                    
                    // Para web normal, guardar en cookie
                    setcookie('jwt_token', $token, time() + 3600, '/', '', false, true);
                    header('Location: /admin/index');
                    exit;
                } else {
                    Usuario::setAlerta('error', 'La contraseña es incorrecta');
                }
            }
        }
    }

    $alertas = Usuario::getAlertas();

    $router->render('login/login', [
        'usuario' => $usuario,
        'alertas' => $alertas
    ]);
}
    
    public static function logout()
    {
        // Eliminar cookie JWT
        setcookie('jwt_token', '', time() - 3600, '/');
        header('Location: /');
    }
}