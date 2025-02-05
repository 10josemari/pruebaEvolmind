<?php

// Incluir el archivo helper
include_once __DIR__ . '/../utils/helpers.php';

/**
 * Clase Database
 * 
 * Esta clase se encarga de la conexión a la BD utilizando PDO
 */
class Database {
    // Propiedades para la configuración de la BD
    private $host = 'mysql_db';
    private $db_name = 'prueba_evolmind';
    private $username = 'user';
    private $password = 'password';
    private $conn;

    /**
     * Método para obtener la conexión a la BD
     * 
     * @return PDO|null|string Retorna una instancia de la conexión a la BD o null si falla
     */
    public function getConnection(): PDO|null|string {
        // Iniciamos la conexión a null
        $this->conn = null;

        try {
            // Conexión usando PDO
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Almacenamos la conexión en una variable global para poder acceder a ella desde cualquier ubicación del código
            $GLOBALS['db'] = $this->conn;
        } catch (PDOException $e) {
            // Llamar al helper para registrar el error
            logError("[Database.php] Error de conexión: " . $e->getMessage());

            // Lanzamos una excepción para que el error se pueda manejar en index.php
            return null;
        }

        // Si se hace bien la conexión, la retornamos
        return $this->conn;
    }
}
