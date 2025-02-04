<?php

// Incluir el archivo del modelo
include_once 'models/Category.php';

/**
 * Clase CategoryController
 *
 * Esta clase es responsable de gestionar las operaciones relacionadas con las categorías en la aplicación
 */
class CategoryController {

    public function __construct() {
        // Aquí podríamos hacer inicializaciones si fueran necesarias.
    }

    /**
     * Obtenemos todas las categorías existentes
     */
    public function listCategories(): array {
        // Instancia del modelo
        $categoryModel = new Category($GLOBALS['db']);
        
        // Devolver los datos de las categorías
        return $categoryModel->getAllCategories();
    }
}
