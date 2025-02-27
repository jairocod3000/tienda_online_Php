<?php

namespace Models;

use Lib\BaseDatos;

/**
 * 
 *
 * Gestiona toda la información relacionada con los productos, incluyendo su creación,
 * recuperación y actualización en la base de datos.
 */
class Producto {
    private ?int $id;
    private ?string $nombre;
    private ?string $descripcion;
    private ?float $precio;
    private ?int $categoria_id;
    private ?int $stock;
    private ?string $oferta;
    private ?string $imagen;

    private BaseDatos $db;

    /**
     * Constructor de Producto.
     *
     * @param int|null $id ID del producto.
     * @param string|null $nombre Nombre del producto.
     * @param string|null $descripcion Descripción del producto.
     * @param float|null $precio Precio del producto.
     * @param int|null $stock Cantidad de stock disponible.
     * @param string|null $oferta Oferta aplicada al producto.
     * @param int|null $categoria_id ID de la categoría a la que pertenece el producto.
     * @param string|null $imagen Imagen del producto.
     */
    public function __construct(?int $id = null, ?string $nombre = null, ?string $descripcion = null, ?float $precio = null, ?int $stock = null, ?string $oferta = null, ?int $categoria_id = null, ?string $imagen = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->oferta = $oferta;
        $this->categoria_id = $categoria_id;
        $this->imagen = $imagen;
        $this->db = new BaseDatos();
    }

    // Getters y setters de los atributos de producto

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    public function getOferta(): string {
        return $this->oferta;
    }

    public function setOferta(string $oferta): void {
        $this->oferta = $oferta;
    }

    public function getCategoriaId(): int {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): void {
        $this->categoria_id = $categoria_id;
    }

    public function getImagen(): string {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void {
        $this->imagen = $imagen;
    }
}
