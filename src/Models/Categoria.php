<?php

namespace Models;

use Lib\BaseDatos;

/**
 * 
 *
 * Maneja las operaciones relacionadas con las categorías,
 * incluyendo el acceso a la base de datos para guardar y recuperar información de categorías.
 */
class Categoria
{
    /**
     * Identificador único para la categoría.
     * 
     * @var int
     */
    private $id;

    /**
     * Nombre descriptivo de la categoría.
     * 
     * @var string
     */
    private $nombre;

    /**
     * Conexión a la base de datos para realizar operaciones de persistencia.
     * 
     * @var BaseDatos
     */
    private BaseDatos $db;

    /**
     * Constructor que inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        $this->db = new BaseDatos();
    }

    /**
     * Devuelve el ID de la categoría.
     * 
     * @return int El ID actual de la categoría.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Asigna un nuevo ID a la categoría.
     * 
     * @param int $id El nuevo ID para la categoría.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Devuelve el nombre de la categoría.
     * 
     * @return string El nombre actual de la categoría.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Asigna un nuevo nombre a la categoría.
     * 
     * @param string $nombre El nuevo nombre para la categoría.
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}