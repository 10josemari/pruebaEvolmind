<?php

/**
 * Clase Country
 *
 * Modelo de BD tabla `CMP_PAISES`
 */
class Country {
    private $conn;

    /**
     * Constructor recibe la conexión a la BD
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene los paises de `CMP_PAISES`
     *
     * @return array Devuelve un array con la información de los paises existentes
     */
    public function getAllCountries(): array {
        $query = "SELECT PAIS_ID, DESCRIPCION_CORTA FROM CMP_PAISES cp ORDER BY cp.PAIS_ID ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene los ítems de `CMP_PROVINCIAS` según el id de país pasado
     *
     * @param int $id ID del país cuyas provincias queremos obtener
     * @return array Devuelve un array con las provincias del país especificado
     */
    public function getProvByPaisId(int $id): array {
        $query = "SELECT PROVINCIA_ID, NOMBRE 
            FROM CMP_PROVINCIAS cprov 
            WHERE cprov.PAIS_ID = :id";

        // Preparamos la consulta para ser ejecutada
        $stmt = $this->conn->prepare($query);

        // Parámetro `:id`
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutamos la consulta
        $stmt->execute();

        // Devolvemos los resultados obtenidos en formato de array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
