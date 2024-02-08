<?php

require_once realpath('../../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->load();
define('SERVER', $_ENV['HOST']);
define('USER', $_ENV['USER']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DB', $_ENV['DB']);
define('PORT', $_ENV['PORT']);

class Conexion  {
    private static $conexion;
    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            try {
                self::$conexion = new PDO('mysql:host=' . SERVER . ';dbname=' . DB, USER, PASSWORD);
                self::$conexion->exec('SET CHARACTER SET utf8');
                return self::$conexion;
            } catch (PDOException $e) {
                echo 'Error en la conexion de base de datos: ' . $e;
                die();
            }
        } else {
            return self::$conexion;
        }
    }

    public static function obtener_conexion()   {
        $conexion = self::abrir_conexion();
        return $conexion;
    }

    public static function cerrar_conexion()    {
        self::$conexion = null;
    }

    public static function mostrar_datos()  {
        $consulta = Conexion::obtener_conexion()->prepare("select * from personas");
        if (!$consulta -> execute()){
            echo 'No se pudo realizar la consulta';
        } else {
            $dato = $consulta->fetchAll (PDO::FETCH_ASSOC);
            echo print_r($dato);
            echo 'Se completo la peticion';
        }
    }

//insercion de datos 👇
    public static function insertar_datos($nombre,$apellido,$edad) {
        try {
            //code...
            $conexion = self::obtener_conexion();
            $consulta = $conexion->prepare("INSERT INTO personas (nombre, apellido, edad) VALUES (:nombre, :apellido, :edad)");
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellido', $apellido);
            $consulta->bindParam(':edad', $edad);
                if ($consulta->execute()) {
                    # code...
                    echo "datos insertador incorrectamente";
                } else  {
                    echo "Error al insertar datos";
                }

        } catch (PDOException $e) {
            //throw $th;
            echo "Error en la insercion de los datos: " .$e;
        }
    }

    modificacion de los datos 👇
    public static function modificar_datos($id, $nombre, $apellido, $edad) {
        try {
            code...
        $conexion = self::obtener_conexion();
        $consulta = $conexion->prepare("UPDATE personas SET nombre = :nombre, apellido = :apellido, edad = :edad WHERE id = :id");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':edad', $edad);
        $consulta->bindParam(':id', $id);
        if ($consulta->execute()) {
            echo "Datos modificados correctamente";
        } else {
            echo "No se pudieron modificar los datos";
        }
        } catch (PDOException $e) {
            throw $th;
            echo "Error en la insercion de los datos: " .$e;
        }
    }
}

Conexion::mostrar_datos();
Conexion::insertar_datos('Erik','Ibarra', 32);
Conexion::mostrar_datos();
// Conexion::modificar_datos(1, 'Juan', 'González', 32);
?>