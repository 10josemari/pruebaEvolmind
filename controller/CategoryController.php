<?php

// Incluir el archivo del modelo
include_once __DIR__ . '/../models/Category.php';

/**
 * Clase CategoryController
 *
 * Esta clase es responsable de gestionar las operaciones relacionadas con las categorías en la aplicación
 */
class CategoryController {
    private $categoryModel;

    /**
     * Constructor de la clase CategoryController
     */
    public function __construct()
    {
        // Instancia del modelo
        $this->categoryModel = new Category($GLOBALS['db']);
    }

    /**
     * Obtiene todas las categorías existentes
     *
     * @return array Devuelve un array con la información de todas las categorías existentes
     */
    public function getListCategories(): array {
        // Devolvemos información de las categorías
        return $this->categoryModel->getAllCategories();
    }

    /**
     * Obtiene los ítems de una categoría específica con paginación
     *
     * @param int $id ID de la categoría cuyos ítems queremos obtener
     * @param int $limit  Número máximo de ítems a recuperar (por defecto 5)
     * @param int $offset Número de ítems a omitir (para paginación, por defecto 0)
     * @return array Devuelve un array con los ítems de la categoría especificada
     */
    public function getItemsByCategory(int $id, int $limit = 5, int $offset = 0): array {
        // Devolvemos los items según la categoría
        return $this->categoryModel->getItemsByCategoryId($id, $limit, $offset);
    }

    /**
     * Obtiene el número total de ítems por categoría específica
     *
     * @param int $id ID de la categoría cuyos número de items queremos obtener
     * @return int Devuelve un int según el número de ítems
     */
    public function getCountItemsByCategory(int $id): int {
        // Devolvemos el número de items según la categoría
        return $this->categoryModel->getCountItemsByCategory($id);
    }
}
