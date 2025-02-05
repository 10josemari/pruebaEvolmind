<?php
// Archivo de conexión para iniciar la conexión a BD
include_once '../../database/DbConnect.php';

// Incluimos el controlador de Category para llamar al método `getItemsByCategory`
include_once '../CategoryController.php';

// Incluimos el controlador de Pais para llamar al método `getProvByPaisId`
include_once '../CountryController.php';

// Incluimos el controlador de Cupon para llamar al método `insertCupon`
include_once '../CuponController.php';

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

// Verificamos que desde la llamada AJAX traemos el parámetro action con el valor de `getProvByPaisId`
if (isset($_GET['action']) && $_GET['action'] == 'getProvByPaisId') {
    // Instancia de controlador
    $countryController = new CountryController();

    // Tratamos los parámetros para llamar al método `getProvByPaisId`
    if (isset($_GET['pais_id'])) {
        $paisId = $_GET['pais_id'];

        // Obtener las provincias según el pais
        $items = $countryController->getProvByPaisId($paisId);

        // Si se encuentran ítems, devolverlos en formato JSON
        if (!empty($items)) {
            echo json_encode([
                'items' => $items,
            ]);
        } else {
            echo json_encode([
                'items' => 'empty',
            ]);
        }
    }
}

// Verificamos que desde la llamada AJAX traemos el parámetro action con el valor de `createRegisterCupon`
if (isset($_POST['action']) && $_POST['action'] == 'createRegisterCupon') {
    // Instancia de controlador
    $cuponController = new CuponController();

    // Recibimos los datos del formulario
    $formData = $_POST['data'];

    // Llamamos al método que se encarga de crear cupon pasando formData
    $cupon = $cuponController->createRegisterCupon($formData);

    // Si se devuelve un array, se indica que hay errores (validación)
    if (is_array($cupon)) {
        if (isset($cupon['error']) && $cupon['error'] == 'technical_error') {
            // Si es un error técnico, no mostramos los detalles
            echo json_encode([
                'error' => 'Hubo un error técnico. Por favor, intenta más tarde.'
            ]);
        } else {
            // Si es otro tipo de error, mostramos los errores específicos
            echo json_encode([
                'errors' => $cupon,
            ]);
        }
    } else {
        // Si la respuesta es exitosa, devolvemos el resultado
        echo json_encode([
            'result' => $cupon,
        ]);
    }
}