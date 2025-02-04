<?php

/**
 * Clase Category
 *
 * Modelo de BD tabla `tblcategorias`
 */
class Category {
    private $conn;

    // Constructor recibe la conexión a la BD
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtenemos los campos `idCategoria`, `sNombre` y `iOrden`
     */
    public function getAllCategories(): array {
        $query = "SELECT idCategoria, sNombre, iOrden FROM tblcategorias ORDER BY iOrden ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
