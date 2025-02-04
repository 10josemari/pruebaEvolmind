<?php
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
            // En caso de error, lo volcamos a un archivo log para tener los errores localizados
            /*$errorMessage = "Error de conexión: " . $e->getMessage();
            $logFile = 'storage/log/log_' . date('Y-m-d') . '.txt';

            // Verificamos si la carpeta 'storage/log' existe, si no, la creamos
            if (!is_dir('storage/log')) {
                mkdir('storage/log', 0777, true);
            }

            // Escribimos el error en el archivo log
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $errorMessage . PHP_EOL, FILE_APPEND);

            // Retornamos null para así manejar el error
            return null;*/
            $GLOBALS['db'] = 'Error de conexión';

            return null;
        }

        // Si se hace bien la conexión, la retornamos
        return $this->conn;
    }
}
