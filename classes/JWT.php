<?php
namespace Classes;

class JWT {
    private static $clave_secreta = 'TuClaveSecretaSuperSeguraYCompleja123!@#'; // Clave secreta para firmar el token
    
    public static function crearToken($datos) {
        // 1. Crear el header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        
        // 2. Crear el payload (datos)
        $payload = json_encode([
            'iat' => time(), // Tiempo de creación
            'exp' => time() + (60 * 60), // Expira en 1 hora
            'data' => $datos // Tus datos de usuario
        ]);
        
        // 3. Codificar a Base64Url
        $base64UrlHeader = self::base64UrlEncode($header);
        $base64UrlPayload = self::base64UrlEncode($payload);
        
        // 4. Crear la firma
        $firma = hash_hmac(
            'sha256',
            $base64UrlHeader . "." . $base64UrlPayload,
            self::$clave_secreta,
            true
        );
        
        $base64UrlFirma = self::base64UrlEncode($firma);
        
        // 5. Combinar todo
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlFirma;
    }
    
    public static function verificarToken($token) {
        // 1. Dividir el token
        $partes = explode('.', $token);
        if (count($partes) !== 3) return false;
        
        list($header, $payload, $firma) = $partes;
        
        // 2. Verificar la firma
        $firmaCalculada = self::base64UrlEncode(
            hash_hmac(
                'sha256',
                $header . "." . $payload,
                self::$clave_secreta,
                true
            )
        );
        
        if ($firma !== $firmaCalculada) return false;
        
        // 3. Obtener los datos
        $datos = json_decode(self::base64UrlDecode($payload), true);
        
        // 4. Verificar expiración
        if (isset($datos['exp']) && $datos['exp'] < time()) {
            return false;
        }
        
        return $datos;
    }
    
    private static function base64UrlEncode($data) {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($data)
        );
    }
    
    private static function base64UrlDecode($data) {
        return base64_decode(str_replace(
            ['-', '_'],
            ['+', '/'],
            $data
        ));
    }
}