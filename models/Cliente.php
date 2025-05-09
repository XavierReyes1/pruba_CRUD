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
        $this->fecha_registro = $args['fecha_registro'] ??  date('Y-m-d');
    }

        public function validar() {
            static::$alertas = ['error' => [], 'exito' => []];

            // Validar nombre
            if (!$this->nombre) {
                static::setAlerta('error', 'El nombre es obligatorio');
            } elseif (strlen($this->nombre) < 3) {
                static::setAlerta('error', 'El nombre debe tener al menos 3 caracteres');
            }

            // Validar apellido
            if (!$this->apellido) {
                static::setAlerta('error', 'El apellido es obligatorio');
            }

            // Validar email
            if (!$this->email) {
                static::setAlerta('error', 'El email es obligatorio');
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                static::setAlerta('error', 'El email no es válido');
            } else {
                // Verificar unicidad del email
                $clienteExistente = static::buscar('email', $this->email);
                if ($clienteExistente && $clienteExistente->id !== $this->id) {
                    static::setAlerta('error', 'El email ya está registrado');
                }
            }

            // Validar teléfono (opcional, pero debe tener formato internacional si se proporciona)
            if ($this->telefono && !preg_match('/^\+\d{1,3}\s?\d{4,14}$/', $this->telefono)) {
                static::setAlerta('error', 'El teléfono debe tener un formato internacional válido');
            }

            // Validar país
            $paisesValidos = ['Honduras','México', 'Estados Unidos', 'Canadá', 'España', 'Argentina']; // Lista de países válidos
            if (!$this->pais || !in_array($this->pais, $paisesValidos)) {
                static::setAlerta('error', 'Debe seleccionar un país válido');
            }

            return static::$alertas;
        }

}