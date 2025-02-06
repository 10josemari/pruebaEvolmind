<?php

/**
 * Class Validator
 *
 * Esta clase se encarga de validar los datos recibidos en un formulario
 * Realiza varias validaciones para asegurarse de que los datos sean correctos antes de ser procesados o almacenados
 */
class Validator {

    /**
     * Errores de validación
     * @var array
     */
    private $errors = [];

    /**
     * Valida los datos de un formulario
     *
     * Este método recibe un array con los datos del formulario, los limpia y valida
     *
     * @param array $formData Datos del formulario a validar
     * @return array Retorna un array con los errores encontrados (si existen)
     */
    public function validateData($formData) {
        // Limpiar los datos antes de validarlos
        $formData = array_map("trim", $formData);

        /**
         * Validación del campo 'name'
         * - Error si no se proporciona un nombre
         * - Error si el nombre contiene caracteres no permitidos
         */
        if (empty($formData["name"])) {
            $this->errors["name"] = "Nombre es obligatorio";
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $formData["name"])) {
            $this->errors["name"] = "El nombre solo puede contener letras y espacios";
        }

        /**
         * Validación del campo 'phone'
         * - Error si no se proporciona un teléfono
         * - Error si el teléfono contiene caracteres no permitidos
         */
        if (empty($formData["phone"])) {
            $this->errors["phone"] = "Teléfono es obligatorio";
        } elseif (!preg_match("/^[0-9]+$/", $formData["phone"])) {
            $this->errors["phone"] = "El teléfono solo puede contener números";
        }

        /**
         * Validación del campo 'email'
         * - Error si no se proporciona un email
         * - Error si el email no está bien formado
         */
        if (empty($formData['email'])) {
            $this->errors['email'] = 'El correo electrónico es obligatorio';
        } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'El correo electrónico no es válido';
        }

        /**
         * Validación del campo 'pais'
         * - Error si no se proporciona un país
         */
        if (empty($formData["pais"])) {
            $this->errors["pais"] = "Debes seleccionar un país";
        }

        /**
         * Validación del campo 'provincia'
         * - Error si no se proporciona una provincia
         */
        if (isset($formData["provincia"]) && empty($formData["provincia"])) {
            $this->errors["provincia"] = "Provincia es obligatoria";
        }

        /**
         * Validación del campo 'c.p.'
         * - Error si no se proporciona un c.p.
         */
        if (empty($formData["cp"])) {
            $this->errors["cp"] = "C.P. es obligatorio";
        }

        /**
         * Validación del check 'condiciones'
         * - Error si no se marca el check de aceptar condiciones
         */
        if ($formData["condiciones"] == 'false') {
            $this->errors["condiciones"] = "Es necesario marcar el check de condiciones legales";
        }

        // Retorna los errores encontrados
        return $this->errors;
    }
}
