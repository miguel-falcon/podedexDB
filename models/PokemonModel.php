<?php
require_once '../config/database.php';

class PokemonModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllPokemon() {
        $query = "SELECT * FROM pokemon";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPokemon($name, $type, $level) {
        $query = "INSERT INTO pokemon (name, type, level) VALUES (:name, :type, :level)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':level', $level);
        return $stmt->execute();
    }

    public function updatePokemon($id, $name, $type, $level) {
        $query = "UPDATE pokemon SET name = :name, type = :type, level = :level WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':level', $level);
        return $stmt->execute();
    }

    public function deletePokemon($id) {
        $query = "DELETE FROM pokemon WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>