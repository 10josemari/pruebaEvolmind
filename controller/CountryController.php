<?php

// Incluir el archivo del modelo
include_once __DIR__ . '/../models/Country.php';

/**
 * Clase CountryController
 *
 * Esta clase es responsable de gestionar las operaciones relacionadas con los paises
 */
class CountryController {
    private $paisModel;

    /**
     * Constructor de la clase PaisController
     */
    public function __construct()
    {
        // Instancia del modelo
        $this->paisModel = new Country($GLOBALS['db']);
    }

    /**
     * Obtiene todos los paises existentes
     *
     * @return array Devuelve un array con la información de todos los paises
     */
    public function getListCountries(): array {
        // Devolvemos información de los paises
        return $this->paisModel->getAllCountries();
    }

    /**
     * Obtiene las provincias de un país específica
     *
     * @param int $id ID del país cuyas provincias queremos obtener
     * @return array Devuelve un array con las provincias del país especificado
     */
    public function getProvByPaisId(int $id): array {
        // Devolvemos las provincias según el país
        return $this->paisModel->getProvByPaisId($id);
    }
}
