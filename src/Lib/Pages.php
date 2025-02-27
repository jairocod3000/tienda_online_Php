<?php

namespace Lib;

class Pages
{
    /**
     * Renderiza una página utilizando una plantilla base con cabecera y pie de página.
     *
     * @param string $pageName Nombre del archivo de la vista principal a cargar.
     * @param array|null $params Parámetros a pasar a la vista, opcional.
     */
    public function render(string $pageName, array $params = null): void
    {
        
        if ($params !== null) {
            extract($params);
        }

        /**
        * Devuelve la ruta al directorio de vistas.
        *
        * @return string Ruta completa al directorio de vistas.
        */

        $viewsPath = dirname(__DIR__, 1) . "/Views/";

        /**
        * Carga los archivos de la vista específica y los archivos de plantilla comunes.
        *
        * @param string $pageName Nombre del archivo de la vista principal a cargar.
        */

        require_once $viewsPath . "portfolio/header.php";
        require_once $viewsPath . "$pageName.php";
        require_once $viewsPath . "portfolio/footer.php";
    }
}
