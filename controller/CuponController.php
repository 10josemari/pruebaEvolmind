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
     * Insertar un registro en la tabla `tblcupon`
     *
     * @param array $formData Datos del formulario a insertar
     * @return array|string|bool Devuelve `true` si la inserción fue exitosa, un `array` con errores o un `string` en caso de fallo técnico.
     */
    public function createRegisterCupon($formData): mixed {
        try {
            // Validamos los datos y los devolvemos si hay errores
            $errors = $this->validator->validateData($formData);
            if (!empty($errors)) {
                return $errors;
            }
        
            // Si no hay errores, insertamos el cupon en BD
            $insertResult = $this->cuponModel->insertCupon($formData);
            if($insertResult == false){
                // Retornamos un error que trataremos en la salida del archivo AJAX `ajax_handler`
                return ['error' => 'technical_error'];
            }

            // Si esta todo correcto, retornamos true
            return true;
        } catch (Exception $e) {
            // Registramos el error en el log
            logError("[CuponController.php] Error: " . $e->getMessage());

            // Retornamos un error que trataremos en la salida del archivo AJAX `ajax_handler`
            return ['error' => 'technical_error'];
        }
    }
}
