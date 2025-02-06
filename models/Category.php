<?php

// Incluir el archivo helper
include_once __DIR__ . '/../utils/helpers.php';

/**
 * Clase Category
 *
 * Modelo de BD tabla `tblcategorias`
 */
class Category {
    private $conn;

    /**
     * Constructor recibe la conexión a la BD
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene las categorías
     *
     * @return array Devuelve un array con las categorías existentes
     */
    public function getAllCategories(): array {
        try {
            $query = "SELECT idCategoria, sNombre, iOrden FROM tblcategorias ORDER BY iOrden ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Registramos el error en el log
            logError("[Category.php] Error: " . $e->getMessage());

            return [];
        }
    }

    /**
     * Obtiene los ítems de `tbllistado` según el id de categoría pasada
     * Paginación mediante los parámetros `$limit` y `$offset`
     *
     * @param int $id Id de la categoría por la que filtraremos
     * @param int $limit  Número de registros a obtener
     * @param int $offset Número de registros a omitir para paginación
     * @return array Devuelve un array de la categoría filtrada con sus respectivos ítems
     */
    public function getItemsByCategoryId(int $id, int $limit, int $offset): array {
        try {
            $query = "SELECT idListado, idCategoria, sNombre, sTipoCard,
                sRutaImg, bNueva, iOrden
                FROM tbllistado tLis
                WHERE tLis.idCategoria = :id
                ORDER BY tLis.iOrden ASC
                LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute(); // Ejecutamos la consulta

            // Devolvemos los resultados obtenidos en formato de array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Registramos el error en el log
            logError("[Category.php] Error: " . $e->getMessage());

            return [];
        }
    }

    /**
     * Obtiene el número los ítems de `tbllistado` según el id de categoría pasado
     *
     * @param int $id Id de la categoría por la que filtraremos
     * @return int Devuelve un int según el número de ítems
     */
    public function getCountItemsByCategory(int $id): int {
        try {
            $query = "SELECT COUNT(*) FROM tbllistado tLis WHERE idCategoria = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Ejecutamos la consulta

            // Devolvemos el resultado obtenido en formato entero
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            // Registramos el error en el log
            logError("[Category.php] Error: " . $e->getMessage());

            return 0;
        }
    }
}
