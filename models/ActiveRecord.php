<?php 
namespace Model;

use PDO;

class ActiveRecord{
    protected static $db;
    protected static $tabla ='';
    protected static $columnasDB =[];
    public $id;
    
    public static function setDB($database)  {
        self::$db = $database;
    }
    public static function crearObjeto($registro){
        $objeto = new static();
        foreach ($registro as $key => $value){
            if(property_exists($objeto,$key)){
                    $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna ==='id') continue;
            $atributo[$columna] = $this->$columna ?? ''; 
        }
        return $atributos;
    }
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $stmt = self::$db->query($query);
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([static::class,'crearObjeto'],$registros);
    }
    public static function buscarId($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id=:id";
        $stmt = self::$db->prepare($query);
        $stmt->execute(['id' => $id]); // Cambiar 'excute' por 'execute'
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro ? static::crearObjeto($registro) : null;
    }

    public function crear(){
        $atributo = $this->atributos();
        $columnas = join(',',array_keys($atributo));
        $placeholders = ':'.join(',:',array_keys($atributo));

        $query = "INSERT INTO ".static::$tabla."($columnas) values ($placeholders)";
        $stmt = self::$db->prepare($query);
        $resultado = $stmt->excute($atributo);
        if($resultado){
            $this->id = self::$db->lastInsertId();
        }
        return ['resultado'=> $resultado,'id'=>$this->id];
    }
    public function actualizar(){
        $atributo = $this->atributos();
        $valores = [];
        foreach($atributo as $key => $value){
            $valores[] = "$key = :$key";
        }
        $query = "UPDATE ".static::$tabla." SET ".join(',',$valores)." WHERE id = :id LIMIT 1";
        $atributo['id'] = $this->id;
        $stmt = self::$db->prepare($query);
        $resultado = $stmt->excute($atributo);
        return ['resultado'=> $resultado];
    }

    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id = :id LIMIT 1";
        $stmt = self::$db->prepare($query);
        return   $stmt->excute(['id'=>$this->id]);
    }

}


