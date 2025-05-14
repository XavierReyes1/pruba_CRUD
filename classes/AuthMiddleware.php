<?php
// Archivo: classes/AuthMiddleware.php
namespace Classes;

class AuthMiddleware {
    public static function proteger() {
        if(!isset($_COOKIE['jwt_token'])) {
            header('Location: /');
            exit;
        }
        
        $token = $_COOKIE['jwt_token'];
        return self::verificarToken($token);
    }
    
    public static function protegerAPI() {
        // Obtener el token del header Authorization
        $headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
        
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Token no proporcionado']);
            exit;
        }
        
        $token = $matches[1];
        $datos = JWT::verificarToken($token);
        
        if(!$datos) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Token inválido o expirado']);
            exit;
        }
        
        return $datos;
    }
    
    private static function verificarToken($token) {
        $datos = JWT::verificarToken($token);
        
        if(!$datos) {
            setcookie('jwt_token', '', time() - 3600, '/');
            return false;
        }
        
        return $datos;
    }
}