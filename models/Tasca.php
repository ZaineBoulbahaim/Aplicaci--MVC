<?php
require_once 'config/Database.php';

class Tasca {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Obtener todas las tareas
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tasques ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // Obtener una tarea por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasques WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Crear nueva tarea
    public function create($nom) {
        $stmt = $this->pdo->prepare("INSERT INTO tasques (nom) VALUES (:nom)");
        return $stmt->execute(['nom' => $nom]);
    }

    // Actualizar tarea
    public function update($id, $nom) {
        $stmt = $this->pdo->prepare("UPDATE tasques SET nom = :nom WHERE id = :id");
        return $stmt->execute(['nom' => $nom, 'id' => $id]);
    }

    // Eliminar tarea
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tasques WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
