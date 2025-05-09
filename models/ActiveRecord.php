<?php 
namespace Model;

use PDO;

class ActiveRecord{
    protected static $db;
    protected static $tabla ='';
    protected static $columnasDB =[];
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
        $query = "SELECT * FROM ".static::$tabla." Where id=:id";
        $stmt = self::$db->prepare($query);
        $stmt = self::$db->excute(['id'=> $id]);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro ? static::crearObjeto($registro): null;
    }

    public function crear(){
        $atributo = $this->atributos();
        $columnas = join(',',array_keys($atributo));
        $placeholders = ':'.join(',:',array_keys($atributo));

        $query = "INSERT INTO ".static::$tabla."($columnas) values ($placeholders)";
  
    }


}


