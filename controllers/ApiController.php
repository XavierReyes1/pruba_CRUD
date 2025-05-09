<?php

namespace Controller;

use Model\Cliente;

class ApiController {
    public static function obtenerClientes() {
        $clientes = Cliente::all();
        echo json_encode($clientes);
    }

    public static function crearCliente() {
        $cliente = new Cliente($_POST);
        $alertas = $cliente->validar();

        if (empty($alertas['error'])) {
            $resultado = $cliente->guardar();
            echo json_encode(['resultado' => $resultado]);
        } else {
            echo json_encode(['error' => $alertas['error']]);
        }
    }

    public static function actualizarCliente() {
        $id = $_GET['id'] ?? null;
        $cliente = Cliente::buscar('id', $id);

        if ($cliente) {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();

            if (empty($alertas['error'])) {
                $resultado = $cliente->guardar();
                echo json_encode(['resultado' => $resultado]);
            } else {
                echo json_encode(['error' => $alertas['error']]);
            }
        } else {
            echo json_encode(['error' => 'Cliente no encontrado']);
        }
    }

    public static function eliminarCliente() {
        $id = $_POST['id'] ?? null;
        $cliente = Cliente::buscar('id', $id);

        if ($cliente) {
            $resultado = $cliente->eliminar();
            echo json_encode(['resultado' => $resultado]);
        } else {
            echo json_encode(['error' => 'Cliente no encontrado']);
        }
    }
}