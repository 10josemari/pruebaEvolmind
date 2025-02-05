<?php

// Incluir el archivo del modelo
include_once __DIR__ . '/../models/Cupon.php';

// Incluir archivos para manejo de validación
require_once __DIR__ . '/../utils/Validator.php';

// Incluir el archivo helper
include_once __DIR__ . '/../utils/helpers.php';

/**
 * Clase CuponController
 *
 * Esta clase es responsable de gestionar las operaciones relacionadas con cupon
 */
class CuponController {
    private $cuponModel;
    private $validator;

    /**
     * Constructor de la clase CuponController
     */
    public function __construct()
    {
        // Instancia del modelo
        $this->cuponModel = new Cupon($GLOBALS['db']);
        // Instanciamos el validador
        $this->validator = new Validator();
    }

    /**
     * Insertamos un registro en la tabla `tblcupon`
     *
     * @param array $formData Datos del formulario a insertar
     * @return mixed Devuelve true si la inserción fue exitosa o un array con los errores
     */
    public function createRegisterCupon($formData): mixed {
        try {
            // Realizamos la validación de los datos
            $errors = $this->validator->validateData($formData);
        
            // Si hay errores, los retornamos y detenemos la ejecución
            if (!empty($errors)) {
                return $errors; // Esto termina la ejecución de la función si hay errores
            }
        
            // Si no hay errores, intentamos insertar el cupon en la base de datos
            $insertResult = $this->cuponModel->insertCupon($formData);

            // Retornamos lo que devuelva el insert
            return $insertResult;
        } catch (Exception $e) {
            // Llamar al helper para registrar el error
            logError("[CuponController.php] Error: " . $e->getMessage());

            // Capturamos cualquier error inesperado y lo retornamos
            return ['error' => 'technical_error'];
        }
    }
}
