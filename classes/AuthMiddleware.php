<?php
// Archivo: classes/AuthMiddleware.php
namespace Classes;

class AuthMiddleware
{

    // AuthMiddleware.php (ajustado para claridad)
    public static function proteger()
    {
        $token = $_COOKIE['jwt_token'] ?? null;

        if (!$token) {
            header('Location: /login');
            exit;
        }

        $datos = JWT::verificarToken($token);

        if (!$datos) {
            setcookie('jwt_token', '', time() - 3600, '/');
            header('Location: /');
            exit;
        }

        return $datos;
    }
    public static function protegerAPI()
    {
        // Obtener el token del header Authorization
        // 1. Intenta desde el header
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';
        $token = null;

        if (preg_match('/Bearer\s+(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // 2. Si no hay header, intenta desde la cookie
        if (!$token) {
            $token = $_COOKIE['jwt_token'] ?? null;
        }

        // 3. Si no hay token aún, rechaza
        if (!$token) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Token no proporcionado']);
            exit;
        }

        // 4. Verifica token
        $datos = JWT::verificarToken($token);

        if (!$datos) {
            setcookie('jwt_token', '', time() - 3600, '/');
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Token inválido o expirado']);
            exit;
        }

        return $datos;
    }
}
