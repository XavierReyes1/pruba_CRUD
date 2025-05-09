<?php 

namespace MVC;

class Router {
    public array $getRouter = [];
    public array $postRouter = [];
    public array $putRouter = [];
    public array $deleteRouter = [];

    public function get($url, $fn) {
        $this->getRouter[$url] = $fn; 
    }

    public function post($url, $fn) {
        $this->postRouter[$url] = $fn; 
    }

    public function put($url, $fn) {
        $this->putRouter[$url] = $fn;
    }

    public function delete($url, $fn) {
        $this->deleteRouter[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Leer el cuerpo de la solicitud para PUT y DELETE
        if ($metodo === 'PUT' || $metodo === 'DELETE') {
            parse_str(file_get_contents("php://input"), $_POST);
        }

        if ($metodo === 'GET') {
            $fn = $this->getRouter[$urlActual] ?? null;
        } elseif ($metodo === 'POST') {
            $fn = $this->postRouter[$urlActual] ?? null;
        } elseif ($metodo === 'PUT') {
            $fn = $this->putRouter[$urlActual] ?? null;
        } elseif ($metodo === 'DELETE') {
            $fn = $this->deleteRouter[$urlActual] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Url no encontrada";
        }
    }

    public function render($view, $datos) {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . '/views/' . $view . '.php';
        $contenido = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }
}