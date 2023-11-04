<?php

namespace App\Models;

use PDO;
use PDOException;

class Producto extends Conexion
{
    // Atributos de la clase
    private int $codigo;
    private string $nombre;
    private float $precio;

    // Constructor de la clase
    public function __construct()
    {
        parent::setConexion();
    }

    // CRUD (Create, Read, Update, Delete)

    // Método para crear un nuevo producto
    public function create(): void
    {
        $q = "INSERT INTO producto (nombre, precio) VALUES(:n, :p)";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->precio
            ]);
        } catch (PDOException $ex) {
            die("Error al crear un articulo: " . $ex->getMessage());
        }

        parent::$conexion = null;
    }

    // Método para obtener todos los productos
    public static function read(): array
    {
        parent::setConexion();
        $q = "SELECT * FROM producto ORDER BY codigo DESC";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al leer los registros: " . $ex->getMessage());
        }

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para eliminar un producto por su código
    public static function delete(int $codigo): void
    {
        parent::setConexion();
        $q = "DELETE FROM producto WHERE codigo= :i";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute([
                ':i' => $codigo
            ]);
        } catch (PDOException $ex) {
            die("Error borrando el producto: " . $ex->getMessage());
        }

        parent::$conexion = null;
    }

    // Método para actualizar un producto por su código
    public function update(int $codigo): void
    {
        $q = "UPDATE producto SET nombre=:n, precio=:p WHERE codigo= :i";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->precio,
                ':i' =>  $codigo
            ]);
        } catch (PDOException $ex) {
            die("Error al modificar el producto: " . $ex->getMessage());
        }

        parent::$conexion = null;
    }

    // Métodos auxiliares

    // Método para obtener un producto por su código
    public static function getProductById(int $codigo)
    {
        parent::setConexion();
        $q = "SELECT * FROM producto WHERE codigo= :i";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute([
                ':i' => $codigo
            ]);
        } catch (PDOException $ex) {
            die("Error, no se encuentra el producto con el codigo dado: " . $ex->getMessage());
        }

        parent::$conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // SETTERS de los atributos:

    // Método para establecer el código del producto
    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;
        return $this;
    }

    // Método para establecer el nombre del producto
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    // Método para establecer el precio del producto
    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;
        return $this;
    }
}
