<?php
class Contacto {
    private $conn;
    private $table_name = "contactos";

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $direccion;
    public $fecha_creacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
    
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, telefono, email, direccion)
                  VALUES (:nombre, :apellido, :telefono, :email, :direccion)";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);

        if ($stmt->execute()) {
            return true;  
        }

        return false;  
    }


    public function leer() {

        $query = "SELECT id, nombre, apellido, telefono, email, direccion, fecha_creacion FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;  
    }

    public function leerUno() {
      
        $query = "SELECT id, nombre, apellido, telefono, email, direccion, fecha_creacion
                  FROM " . $this->table_name . " WHERE id = :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->telefono = $row['telefono'];
            $this->email = $row['email'];
            $this->direccion = $row['direccion'];
            $this->fecha_creacion = $row['fecha_creacion'];
        }
    }

    public function actualizar() {

        $query = "UPDATE " . $this->table_name . "
                  SET nombre = :nombre, apellido = :apellido, telefono = :telefono,
                      email = :email, direccion = :direccion
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;  
        }

        return false;  
    }

    public function eliminar() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;  
        }

        return false;  
    }
}
