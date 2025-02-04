<?php
// Archivo de conexión para iniciar la conexión a BD
include_once '../../database/DbConnect.php';

// Incluimos el controlador de Category para llamar al método `getItemsByCategory`
include_once '../CategoryController.php';

// Verificamos que desde la llamada AJAX traemos el parámetro action con el valor de `getItemsByCategoryMore`
if (isset($_GET['action']) && $_GET['action'] == 'getItemsByCategoryMore') {
    // Instancia de controlador
    $categoryController = new CategoryController();

    // Tratamos los parámetros para llamar al método `getItemsByCategory`
    if (isset($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

        // Obtener los ítems según la categoría y paginación
        $items = $categoryController->getItemsByCategory($categoryId, $limit, $offset);

        // Si se encuentran ítems, devolverlos en formato JSON
        if (!empty($items)) {
            echo json_encode([
                'success' => true,
                'items' => $items,
            ]);
        }
    }
}

// Verificamos que desde la llamada AJAX traemos el parámetro action con el valor de `getItemsByCategoryLess`
if (isset($_GET['action']) && $_GET['action'] == 'getItemsByCategoryLess') {
    // Instancia de controlador
    $categoryController = new CategoryController();

    // Tratamos los parámetros para llamar al método `getItemsByCategory`
    if (isset($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;

        // Obtener los ítems según la categoría y paginación
        $items = $categoryController->getItemsByCategory($categoryId, $limit, $offset);

        // Si se encuentran ítems, devolverlos en formato JSON
        if (!empty($items)) {
            echo json_encode([
                'success' => true,
                'items' => $items,
            ]);
        }
    }
}