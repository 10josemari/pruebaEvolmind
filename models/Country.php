<?php

// Incluir el archivo helper
include_once __DIR__ . '/../utils/helpers.php';

/**
 * Clase Country
 *
 * Modelo de BD tabla `CMP_PAISES`
 */
class Country {
    private $conn;

    /**
     * Constructor que recibe la conexión a la BD
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los paises
     *
     * @return array Devuelve un array con los paises existentes
     */
    public function getAllCountries(): array {
        try {
            $query = "SELECT PAIS_ID, DESCRIPCION_CORTA FROM CMP_PAISES cp ORDER BY cp.PAIS_ID ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Registramos el error en el log
            logError("[Country.php] Error: " . $e->getMessage());

            return [];
        }
    }

    /**
     * Obtiene los ítems de `CMP_PROVINCIAS` según el id de país pasado
     *
     * @param int $id ID del país cuyas provincias queremos obtener
     * @return array Devuelve un array con las provincias del país especificado
     */
    public function getProvByPaisId(int $id): array {
        try {
            $query = "SELECT PROVINCIA_ID, NOMBRE
                FROM CMP_PROVINCIAS cprov
                WHERE cprov.PAIS_ID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Ejecutamos la consulta

            // Devolvemos los resultados obtenidos en formato de array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Registramos el error en el log
            logError("[Country.php] Error: " . $e->getMessage());

            return [];
        }
    }
}
