<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Base DE DATOS
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id', 'email', 'password'];
    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';

    }

     public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El Email es Obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no Valido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password no puede ir vacio";
        }
        return self::$alertas;
    }
    
}
