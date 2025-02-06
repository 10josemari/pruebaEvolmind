<?php

/**
 * Clase Cupon
 *
 * Modelo de BD para la tabla `tblcupon`
 */
class Cupon {
    private $conn;

    /**
     * Constructor que recibe la conexión a la BD
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtener el próximo ID para el cupon
     *
     * @return int El siguiente ID disponible para `idCupon`
     */
    public function getIdCupon(): int {
        try {
            // Consultamos el máximo ID actual
            $query = "SELECT MAX(idCupon) AS max_id FROM tblcupon";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Obtenemos el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no hay registros, el primer ID será 1
            $nextId = $result['max_id'] ? $result['max_id'] + 1 : 1;
            return $nextId;
        } catch (PDOException $e) {
            // Lanzamos una excepción
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Insertar un nuevo cupon en la tabla `tblcupon`
     *
     * @param array $data Datos del cupon a insertar
     * @return bool True si la inserción fue exitosa, False si hubo un error
     */
    public function insertCupon($data): bool {
        try {
            // Tratamos el campo PROVINCIA_ID y obtenemos el ID a insertar
            $provincia = empty($data['provincia']) ? '' : $data['provincia'];
            $idCupon = $this->getIdCupon();

            // Preparamos la consulta SQL para insertar el cupon
            $query = "INSERT INTO tblcupon (idCupon, sNombre, sTelefono, sEmail, PAIS_ID, PROVINCIA_ID, sCodigoPostal) VALUES (:id, :name, :phone, :email, :pais, :provincia, :cp)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $idCupon);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':phone', $data['phone']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':pais', $data['pais']);
            $stmt->bindValue(':provincia', $provincia);
            $stmt->bindValue(':cp', $data['cp']);
            $stmt->execute(); // Ejecutamos la consulta

            // Si todo ha ido bien retornamos true
            return true;
        } catch (PDOException $e) {
            // Lanzamos una excepción
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
