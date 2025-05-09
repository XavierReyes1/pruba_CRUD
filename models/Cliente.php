<?php

namespace Model;

class Cliente extends ActiveRecord{
     protected static $tabla ='cliente';
    protected static $columnasDB =['id','nombre','apellido','email','telefono','pais','fecha_registro'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $pais;
    public $fecha_registro;

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->fecha_registro = $args['fecha_registro'] ?? '';
    }

}