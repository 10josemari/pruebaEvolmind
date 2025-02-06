<?php
// Incluir archivos de conexión y controladores
include_once '../../database/DbConnect.php';
include_once '../CategoryController.php';
include_once '../CountryController.php';
include_once '../CuponController.php';

// Obtener ítems por categoría (mostrar más)
if (isset($_GET['action']) && $_GET['action'] == 'getItemsByCategoryMore') {
    $categoryController = new CategoryController();

    if (isset($_GET['category_id'])) {
        // Tratamos los parámetros que uesaremos al llamar a `getItemsByCategory`
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

// Obtener ítems por categoría (mostrar menos)
if (isset($_GET['action']) && $_GET['action'] == 'getItemsByCategoryLess') {
    $categoryController = new CategoryController();

    if (isset($_GET['category_id'])) {
        // Tratamos los parámetros que uesaremos al llamar a `getItemsByCategory`
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

// Obtener provincias por país
if (isset($_GET['action']) && $_GET['action'] == 'getProvByPaisId') {
    $countryController = new CountryController();

    if (isset($_GET['pais_id'])) {
        // Tratamos el parámetro que uesaremos al llamar a `getItemsByCategory`
        $paisId = $_GET['pais_id'];

        // Obtener las provincias según el pais
        $items = $countryController->getProvByPaisId($paisId);

        // Si se encuentran ítems, devolverlos en formato JSON
        if (!empty($items)) {
            echo json_encode([
                'items' => $items,
            ]);
        } else {
            // Si el país pasado no tiene provincias, devolvemos un JSON con el valor 'empty'
            echo json_encode([
                'items' => 'empty',
            ]);
        }
    }
}

// Insertar registro en tabla `tblcupon`
if (isset($_POST['action']) && $_POST['action'] == 'createRegisterCupon') {
    $cuponController = new CuponController();

    // Tratamos los datos de formulario que uesaremos al llamar a `createRegisterCupon`
    $formData = $_POST['data'];

    // Crear cupon pasando los datos del formulario
    $cupon = $cuponController->createRegisterCupon($formData);

    // Si se devuelve un array, se indica que hay errores (validación)
    if (is_array($cupon)) {
        if (isset($cupon['error']) && $cupon['error'] == 'technical_error') {
            // Si es un error técnico, no mostramos los detalles
            echo json_encode([
                'error' => 'Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.'
            ]);
        } else {
            // Si es otro tipo de error, mostramos los errores específicos (validación)
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