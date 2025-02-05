<?php

/**
 * Clase Cupon
 *
 * Modelo de BD tabla `tblcupon`
 */
class Cupon {
    private $conn;

    /**
     * Constructor recibe la conexión a la BD
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
        // Consultamos el máximo ID actual
        $query = "SELECT MAX(idCupon) AS max_id FROM tblcupon";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si no hay registros, el primer ID será 1
        $nextId = $result['max_id'] ? $result['max_id'] + 1 : 1;

        return $nextId;
    }


    /**
     * Insertar un nuevo cupon en la tabla `tblcupon`
     *
     * @param array $data Datos del cupon a insertar
     * @return bool True si la inserción fue exitosa, False si hubo un error
     */
    public function insertCupon($data): bool {
        // Comprobamos si PROVINCIA_ID está vacío, si es así lo seteamos como NULL
        $provincia = empty($data['provincia']) ? '' : $data['provincia'];

        // Obtener el próximo ID
        $idCupon = $this->getIdCupon();

        // Preparamos la consulta SQL para insertar el cupon
        $query = "INSERT INTO tblcupon (idCupon, sNombre, sTelefono, sEmail, PAIS_ID, PROVINCIA_ID, sCodigoPostal) VALUES (:id, :name, :phone, :email, :pais, :provincia, :cp)";

        // Preparamos la declaración
        $stmt = $this->conn->prepare($query);

        // Asignamos los valores de los campos
        $stmt->bindParam(':id', $idCupon);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':pais', $data['pais']);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':cp', $data['cp']);

        // Ejecutamos la consulta y verificamos si fue exitosa
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
