<?php

namespace Repositories;

use Lib\BaseDatos;
use PDO;

/**
 * Repositorio para manejar las operaciones de productos en la base de datos.
 */
class ProductoRepository {
    private BaseDatos $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    /**
     * Recupera todos los productos de la base de datos.
     */
    public function recuperarTodasCategorias() {
        return $this->executeQuery("SELECT * FROM productos");
    }

    /**
     * Recupera cinco productos al azar de la base de datos.
     */
    public function getRandom() {
        return $this->executeQuery("SELECT * FROM productos ORDER BY RAND() LIMIT 5");
    }

    /**
     * Recupera todos los productos por categoría.
     *
     * @param int $categoriaId ID de la categoría.
     */
    public function getByCategoria($categoriaId) {
        return $this->executeQuery("SELECT * FROM productos WHERE categoria_id = :categoriaId", ['categoriaId' => $categoriaId]);
    }

    /**
     * Recupera un producto por su ID.
     *
     * @param int $id ID del producto.
     */
    public function categoriaPorId($id) {
        return $this->executeQuery("SELECT * FROM productos WHERE id = :id", ['id' => $id])[0] ?? null;
    }

    /**
     * Inserta un nuevo producto en la base de datos.
     */
    public function guardarCategoria($categoriaId, $nombre, $descripcion, $precio, $stock, $imagen) {
        $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, imagen) VALUES (:categoriaId, :nombre, :descripcion, :precio, :stock, :imagen)";
        return $this->executeUpdate($sql, [
            'categoriaId' => $categoriaId,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'imagen' => $imagen
        ]);
    }

    /**
     * Elimina un producto de la base de datos por su ID.
     */
    public function borrarCategoria($productId) {
        $this->executeUpdate("DELETE FROM productos WHERE id = :id", ['id' => $productId]);
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function actualizarCategoria($productId, $nombre, $descripcion, $precio, $categoriaId, $imagen) {
        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, categoria_id = :categoriaId, imagen = :imagen WHERE id = :id";
        $this->executeUpdate($sql, [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'categoriaId' => $categoriaId,
            'imagen' => $imagen,
            'id' => $productId
        ]);
    }

    /**
     * Ejecuta consultas de selección y devuelve todos los registros o un valor booleano para las consultas de actualización.
     */
    private function executeQuery($sql, $params = []) {
        $stmt = $this->db->ejecucionDeclaracionSQL($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ejecuta actualizaciones o inserciones y devuelve un booleano.
     */
    private function executeUpdate($sql, $params = []) {
        $stmt = $this->db->ejecucionDeclaracionSQL($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
        return $stmt->execute();
    }
}
