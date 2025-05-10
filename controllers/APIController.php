<?php
namespace Controller;

use Model\Cliente;

class ApiController {

    public static function listar() {
                    session_start();
  sesionActiva();
        header('Content-Type: application/json');
        $busqueda = $_GET['busqueda'] ?? '';
        $clientes = Cliente::filtrar($busqueda);
        echo json_encode([
            'success' => true,
            'data' => $clientes
        ]);
    }

    public static function mostrar() {
                    session_start();
  sesionActiva();
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        $cliente = Cliente::buscar('id', $id);
        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['success' => false, 'mensaje' => 'Cliente no encontrado']);
            return;
        }
        echo json_encode(['success' => true, 'data' => $cliente]);
    }

    public static function crear() {
                    session_start();
  sesionActiva();
        header('Content-Type: application/json');
        $datos = json_decode(file_get_contents('php://input'), true);
        $cliente = new Cliente($datos);
        $errores = $cliente->validar();
        if (!empty($errores['error'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'errores' => $errores]);
            return;
        }
        $cliente->guardar();
        echo json_encode(['success' => true, 'data' => $cliente]);
    }

    public static function actualizar() {
                    session_start();
  sesionActiva();
        header('Content-Type: application/json');
        $datos = json_decode(file_get_contents('php://input'), true);
        $id = $datos['id'] ?? null;
        $cliente = Cliente::buscar('id', $id);
        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['success' => false, 'mensaje' => 'Cliente no encontrado']);
            return;
        }
        $cliente->sincronizar($datos);
        $cliente->fecha_registro = date('Y/m/d');
        $errores = $cliente->validar();
        if (!empty($errores['error'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'errores' => $errores]);
            return;
        }
        $cliente->guardar();
        echo json_encode(['success' => true, 'data' => $cliente]);
    }

    public static function eliminar() {
                    session_start();
  sesionActiva();
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? null;
        $cliente = Cliente::buscar('id', $id);
        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['success' => false, 'mensaje' => 'Cliente no encontrado']);
            return;
        }
        $cliente->eliminar();
        echo json_encode(['success' => true, 'mensaje' => 'Cliente eliminado']);
    }
}
