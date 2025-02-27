<?php

namespace Services;

use Repositories\ProductoRepository;

/**
 * Servicio para gestionar operaciones relacionadas con productos.
 */
class ProductoService {
    private $productoRepository;

    /**
    * Constructor que inyecta el repositorio asociado a las operaciones de productos.
    *
    * @param ProductoRepository $productoRepository Repositorio para gestionar productos.
    */
    public function __construct(ProductoRepository $productoRepository) {
        $this->productoRepository = $productoRepository;
    }

    /**
    * Recupera todas las entradas de productos de la base de datos.
    *
    * @return array Lista de productos.
    */
    public function recuperarTodasCategorias() {
        return $this->productoRepository->recuperarTodasCategorias();
    }

    /**
    * Obtiene un conjunto aleatorio de productos.
    *
    * @return array Lista aleatoria de productos limitada a 5.
    */
    public function getRandom() {
        return $this->productoRepository->getRandom();
    }

    /**
    * Busca productos por categoría específica.
    *
    * @param int $categoriaId El identificador de la categoría de productos.
    * @return array Productos pertenecientes a la categoría especificada.
    */
    public function getByCategoria($categoriaId) {
        return $this->productoRepository->getByCategoria($categoriaId);
    }

    /**
    * Recupera un producto específico por su ID.
    *
    * @param int $id El identificador del producto.
    * @return array Datos del producto específico.
    */
    public function categoriaPorId($id) {
        return $this->productoRepository->categoriaPorId($id);
    }

    /**
    * Guarda un nuevo producto en la base de datos.
    *
    * @param int $categoriaId Identificador de la categoría del nuevo producto.
    * @param string $nombre Nombre del producto.
    * @param string $descripcion Descripción del producto.
    * @param float $precio Precio del producto.
    * @param int $stock Cantidad en stock del producto.
    * @param string $imagen URL de la imagen del producto.
    * @return bool True si el producto se guardó con éxito, false en caso contrario.
    */
    public function guardarCategoria($categoriaId, $nombre, $descripcion, $precio, $stock, $imagen) {
        return $this->productoRepository->guardarCategoria($categoriaId, $nombre, $descripcion, $precio, $stock, $imagen);
    }

    /**
    * Elimina un producto de la base de datos por su ID.
    *
    */
    public function borrarCategoria($productId) {
        return $this->productoRepository->borrarCategoria($productId);
    }

    /**
    * Actualiza los datos de un producto existente en la base de datos.
    *
    */
    public function actualizarCategoria($productId, $nombre, $descripcion, $precio, $categoriaId, $imagen) {
        return $this->productoRepository->actualizarCategoria($productId, $nombre, $descripcion, $precio, $categoriaId, $imagen);
    }
}
