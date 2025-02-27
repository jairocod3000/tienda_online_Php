<?php

namespace Services;

use Repositories\CategoriaRepository;

/**
 * Servicio que actúa como intermediario en el acceso a datos para las categorías.
 */
class CategoriaService {
    private CategoriaRepository $categoriaRepository;

    /**
     * Constructor de CategoriaService.
     *
     * @param CategoriaRepository $categoriaRepository Una instancia del repositorio de categorías.
     */
    public function __construct(CategoriaRepository $categoriaRepository) {
        $this->categoriaRepository = $categoriaRepository;
    }

    /**
     * Recupera todas las categorías disponibles.
     *
     * @return array Lista de todas las categorías.
     */
    public function recuperarTodasCategorias() {
        return $this->categoriaRepository->recuperarTodasCategorias();
    }

    /**
     * Recupera una categoría específica por su ID.
     *
     * @param int $id El ID de la categoría deseada.
     * @return array Datos de la categoría.
     */
    public function categoriaPorId($id) {
        return $this->categoriaRepository->categoriaPorId($id);
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     *
     * @param string $nombre El nombre de la nueva categoría.
     * @return bool True si la operación es exitosa, false de lo contrario.
     */
    public function guardarCategoria($nombre) {
        return $this->categoriaRepository->guardarCategoria($nombre);
    }

    /**
     * Elimina una categoría por su ID.
     *
     * @param int $id El ID de la categoría a eliminar.
     * @return bool True si la eliminación es exitosa, false de lo contrario.
     */
    public function borrarCategoria($id) {
        return $this->categoriaRepository->borrarCategoria($id);
    }

    /**
     * Actualiza los datos de una categoría existente.
     *
     * @param int $id El ID de la categoría a actualizar.
     * @param string $nombre El nuevo nombre de la categoría.
     * @return bool True si la actualización es exitosa, false de lo contrario.
     */
    public function actualizarCategoria($id, $nombre) {
        return $this->categoriaRepository->actualizarCategoria($id, $nombre);
    }
}
