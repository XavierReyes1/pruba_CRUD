<?php 

namespace MVC;

class Router{
    public array $getRouter= [];
    public array $postRouter= [];

    public function get($url,$fn){
        $this->getRouter[$url] = $fn; 
    }
    public function post($url,$fn){
        $this->postRouter[$url] = $fn; 
    }
    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        if($metodo ==='GET'){
            $fn = $this->getRouter[$urlActual] ?? null;
        }else{
            $fn = $this->postRouter[$urlActual] ?? null;
        }
        if($fn){
            call_user_func($fn,$this);
        }else{
            echo "Url no encontrada";
        }
    }

    public function render($view,$datos){
        foreach($datos as $key =>$value){
            $$key = $value;
        }
        ob_start();
        include_once __DIR__.'/views/'.$view.'.php';
        $contenido = ob_get_clean();
        include_once __DIR__.'/views/layout.php';

    }

}