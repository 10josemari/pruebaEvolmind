<?php

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
     * Obtiene las categorías de `tblcategorias`
     *
     * @return array Devuelve un array con la información de las categorías existentes
     */
    public function getAllCategories(): array {
        $query = "SELECT idCategoria, sNombre, iOrden FROM tblcategorias ORDER BY iOrden ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene los ítems de `tbllistado` según el id de categoría pasado
     * Paginación mediante los parámetros `$limit` y `$offset`
     *
     * @param int $id Id de la categoría por la que filtraremos
     * @param int $limit  Número de registros a obtener
     * @param int $offset Número de registros a omitir para paginación
     * @return array Devuelve un array de la categoría filtrada con sus respectivos ítems
     */
    public function getItemsByCategoryId(int $id, int $limit, int $offset): array {
        $query = "SELECT idListado, idCategoria, sNombre, sTipoCard,
                sRutaImg, bNueva, iOrden
            FROM tbllistado tLis
            WHERE tLis.idCategoria = :id
            ORDER BY tLis.iOrden ASC
            LIMIT :limit OFFSET :offset";

        // Preparamos la consulta para ser ejecutada
        $stmt = $this->conn->prepare($query);

        // Parámetros `:id`, `:limit` y `:offset`
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Ejecutamos la consulta
        $stmt->execute();

        // Devolvemos los resultados obtenidos en formato de array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el número los ítems de `tbllistado` según el id de categoría pasado
     *
     * @param int $id Id de la categoría por la que filtraremos
     * @return int Devuelve un int según el número de ítems
     */
    public function getCountItemsByCategory(int $id): int {
        $query = "SELECT COUNT(*) FROM tbllistado tLis WHERE idCategoria = :id";

        // Preparamos la consulta para ser ejecutada
        $stmt = $this->conn->prepare($query);

        // Parámetros `:id`
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutamos la consulta
        $stmt->execute();

        // Devolvemos el resultado obtenido en formato entero
        return $stmt->fetchColumn();
    }
}
