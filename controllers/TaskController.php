<?php

class TaskController {

    private $tasca;
    private $basePath = '/mvc-tasques';

    public function __construct() {
        $this->tasca = new Tasca();
    }

    // Listado
    public function index() {
        $tasques = $this->tasca->getAll();
        require 'views/tasques/index.php';
    }

    // Formulario crear
    public function create() {
        require 'views/tasques/create.php';
    }

    // Guardar nueva tarea
    public function store() {
        $nom = $_POST['nom'] ?? '';

        if (!Validator::validateString($nom)) {
            FlashMessages::addMessage(
                "❌ El nombre de la tarea no es válido",
                "error"
            );
            header("Location: {$this->basePath}/tasques/create");
            exit;
        }

        if ($this->tasca->create($nom)) {
            FlashMessages::addMessage(
                "✅ Tarea creada correctamente",
                "success"
            );
        } else {
            FlashMessages::addMessage(
                "❌ Error al crear la tarea",
                "error"
            );
        }

        header("Location: {$this->basePath}/tasques");
        exit;
    }

    // Formulario editar
    public function edit($id) {
        if (!Validator::validateId($id)) {
            FlashMessages::addMessage("❌ ID inválido", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        $tasca = $this->tasca->getById($id);

        if (!$tasca) {
            FlashMessages::addMessage("❌ La tarea no existe", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        require 'views/tasques/edit.php';
    }

    // Actualizar tarea
    public function update($id) {
        $nom = $_POST['nom'] ?? '';

        if (!Validator::validateId($id) || !Validator::validateString($nom)) {
            FlashMessages::addMessage(
                "❌ Datos inválidos al actualizar",
                "error"
            );
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        if ($this->tasca->update($id, $nom)) {
            FlashMessages::addMessage(
                "✏️ Tarea actualizada con éxito",
                "success"
            );
        } else {
            FlashMessages::addMessage(
                "❌ Error al actualizar la tarea",
                "error"
            );
        }

        header("Location: {$this->basePath}/tasques");
        exit;
    }

    // Eliminar tarea
    public function delete($id) {
        if (!Validator::validateId($id)) {
            FlashMessages::addMessage("❌ ID inválido", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        if ($this->tasca->delete($id)) {
            FlashMessages::addMessage(
                "🗑️ Tarea eliminada correctamente",
                "success"
            );
        } else {
            FlashMessages::addMessage(
                "❌ Error al eliminar la tarea",
                "error"
            );
        }

        header("Location: {$this->basePath}/tasques");
        exit;
    }
}
