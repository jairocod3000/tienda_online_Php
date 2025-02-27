<?php

namespace Repositories;

use Lib\BaseDatos;
use PDO;

/**
 * Repositorio para manejar operaciones con categorías en la base de datos.
 */
class CategoriaRepository {
    private BaseDatos $db;

    /**
     * Constructor de CategoriaRepository.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct() {
        $this->db = new BaseDatos();
    }

    /**
     * Recupera todas las categorías de la base de datos.
     *
     * @return array Lista de todas las categorías.
     */
    public function recuperarTodasCategorias() {
        $consulta = "SELECT * FROM categorias";
        return $this->ejecutarConsultasSeleccion($consulta);
    }

    /**
     * Recupera una categoría por su ID.
     *
     * @param int $id El ID de la categoría.
     * @return array|null Datos de la categoría o null si no se encuentra.
     */
    public function categoriaPorId($id) {
        $consulta = "SELECT * FROM categorias WHERE id = :id";
        return $this->ejecutarConsultasSeleccion($consulta, ['id' => $id]);
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     *
     * @param object $categoria La categoría a guardar.
     * @return bool True si la operación fue exitosa, false de lo contrario.
     */
    public function guardarCategoria($categoria): bool {
        $consulta = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        return $this->ejecutarActualizaciones_Eliminaciones($consulta, ['nombre' => $categoria->getNombre()]);
    }

    /**
     * Elimina una categoría por su ID.
     *
     * @param int $id El ID de la categoría a eliminar.
     * @return bool True si se elimina correctamente, false de lo contrario.
     */
    public function borrarCategoria($id): bool {
        $consulta = "DELETE FROM categorias WHERE id = :id";
        return $this->ejecutarActualizaciones_Eliminaciones($consulta, ['id' => $id]);
    }

    /**
     * Actualiza los datos de una categoría existente.
     *
     * @param int $id El ID de la categoría.
     * @param string $nombre El nuevo nombre de la categoría.
     * @return bool True si la actualización fue exitosa, false de lo contrario.
     */
    public function actualizarCategoria($id, $nombre): bool {
        $consulta = "UPDATE categorias SET nombre = :nombre WHERE id = :id";
        return $this->ejecutarActualizaciones_Eliminaciones($consulta, ['id' => $id, 'nombre' => $nombre]);
    }

    /**
     * Ejecuta consultas de selección en la base de datos.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param array $params Parámetros para la consulta SQL.
     * @return array Resultados de la consulta.
     */
    private function ejecutarConsultasSeleccion($sql, $params = []) {
        $stmt = $this->db->ejecucionDeclaracionSQL($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ejecuta actualizaciones o eliminaciones en la base de datos.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param array $params Parámetros para la consulta SQL.
     * @return bool True si la operación fue exitosa, false de lo contrario.
     */
    private function ejecutarActualizaciones_Eliminaciones($sql, $params = []) {
        $stmt = $this->db->ejecucionDeclaracionSQL($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
}
