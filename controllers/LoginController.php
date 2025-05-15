<?php

namespace Controller;

use MVC\Router;
use Model\Usuario;
use Classes\JWT;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                // Buscar usuario y verificar contraseña de forma segura
                $usuario = Usuario::buscar('email', $usuario->email);

                if (!$usuario || !($_POST['password'] === $usuario->password)) {
                    Usuario::setAlerta('error', 'Usuario o Contraseña incorrectos');
                } else {
                    // Crear token JWT
                    $token = JWT::crearToken([
                        'id' => $usuario->id,
                        'email' => $usuario->email
                    ]);

                    // Para API
                    if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] === 'application/json') {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'token' => $token,
                            'usuario' => $usuario
                        ]);
                        return;
                    }

                    // Para web normal
                    setcookie('jwt_token', $token, [
                        'expires' => time() + 3600,
                        'path' => '/',          // Asegura que la cookie esté disponible en todo el sitio
                        'domain' => '',         // Dominio actual (puedes poner 'tudominio.com' en producción)
                        'secure' => false,      // Cambia a `true` si usas HTTPS
                        'httponly' => true,     // Protege contra XSS
                        'samesite' => 'Lax'     // Previene CSRF
                    ]);

                    

                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index');
                    exit;
                }
            }
        } else {
            $usuario = new Usuario();
        }

        $alertas = Usuario::getAlertas();

        $router->render('login/login', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        // Eliminar la cookie del token
        setcookie('jwt_token', '', time() - 3600, '/');
        header('Location: /');
        exit;
    }
}
