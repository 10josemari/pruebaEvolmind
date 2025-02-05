<?php

class Validator {
    private $errors = [];

    /**
     * Valida los datos recibidos
     * @param array $formData
     * @return array Errores encontrados
     */
    public function validateData($formData) {
        // Limpiar los datos antes de validarlos
        $formData = array_map("trim", $formData);

        // Validación del campo 'name'
        if (empty($formData["name"])) {
            $this->errors["name"] = "Nombre es obligatorio";
        }

        // Validación del campo "phone"
        if (empty($formData["phone"])) {
            $this->errors["phone"] = "Teléfono es obligatorio";
        }

        // Validación del campo 'email'
        if (empty($formData['email'])) {
            $this->errors['email'] = 'El correo electrónico es obligatorio';
        } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'El correo electrónico no es válido';
        }

        // Validación del campo "pais"
        if (empty($formData["pais"])) {
            $this->errors["pais"] = "Debes seleccionar un país";
        }

        // Validación del campo "provincia"
        if (isset($formData["provincia"]) && empty($formData["provincia"])) {
            $this->errors["provincia"] = "Provincia es obligatoria";
        }

        // Validación del campo "cp"
        if (empty($formData["cp"])) {
            $this->errors["cp"] = "C.P. es obligatorio";
        }

        // Validación del campo "condiciones"
        if ($formData["condiciones"] == 'false') {
            $this->errors["condiciones"] = "Es necesario marcar el check de condiciones legales";
        }

        return $this->errors;
    }
}
