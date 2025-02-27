<?php

namespace Controllers;
use Lib\Pages;
use Utils\Utils;
use Models\Categoria;
use Services\ProductoService;
use Repositories\ProductoRepository;
use Services\CategoriaService;
use Repositories\CategoriaRepository;

/**
 * Clase CategoriaController
 *
 * Esta clase maneja la lógica para las acciones relacionadas con las categorías.
 */
class CategoriaController{
    private Pages $pages;
    private ProductoService $productoService;
    private CategoriaService $categoriaService;

    /**
     * Constructor de CategoriaController.
     *
     * Inicializa una nueva instancia de la clase CategoriaController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->productoService = new ProductoService(new ProductoRepository());
        $this->categoriaService = new CategoriaService(new CategoriaRepository());

    }

    /**
     * Obtiene todas las categorías.
     *
     * @return array Las categorías obtenidas.
     */
    public function obtenerCategorias() {
        return $this->categoriaService->recuperarTodasCategorias();
    }

    /**
     * Ver categoría.
     */
    public function ver($id) {
        $categoriaId = $id;
        $productos = $this->productoService->getByCategoria($categoriaId);
        $this->pages->render('categoria/ver', ['productos' => $productos]);
    }

    /**
     * Gestión de las Categorías
     */
    public function gestionarCategorias() {
        $categorias = $this->categoriaService->recuperarTodasCategorias();
        $this->pages->render('categoria/gestionarCategorias', ['categorias' => $categorias]);
    }

    /**
     * Crear Categoría.
     */
    public function crear() {
        if (isset($_POST['nombre'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $this->categoriaService->guardarCategoria($categoria);

            header('Location: ' . BASE_URL);

        } else {
            $this->pages->render('categoria/crear');
        }
    }

    /**
     * Borrar una categoría.
     */
    public function borrar($id) {
        $this->categoriaService->borrarCategoria($id);
        $this->gestionarCategorias();
    }

    /**
     * Editar una categoría.
     */
    public function editar($id) {
        $categoria = $this->categoriaService->categoriaPorId($id);
        $this->pages->render('categoria/gestionarCategorias', ['categoria' => $categoria]);

    }

    /**
     * Actualizar una categoría.
     */
    public function actualizar() {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
            $id = $data['id'];
            $nombre = $data['nombre'];
            $this->categoriaService->actualizarCategoria($id, $nombre);

            $this->gestionarCategorias();
        } 
    }

}