<?php

class TaskController {

    private $tasca; // modelo Tasca para acceder a la base de datos
    private $basePath = '/mvc-tasques'; // ruta base de la aplicación

    public function __construct() {
        $this->tasca = new Tasca(); // crear instancia del modelo
    }

    // Mostrar listado de tareas
    public function index() {
        $tasques = $this->tasca->getAll(); // obtener todas las tareas
        require 'views/tasques/index.php'; // cargar vista de listado
    }

    // Mostrar formulario para crear tarea
    public function create() {
        require 'views/tasques/create.php'; // cargar vista de creación
    }

    // Guardar nueva tarea
    public function store() {
        $nom = $_POST['nom'] ?? ''; // obtener nombre desde POST

        // Validar nombre
        if (!Validator::validateString($nom)) {
            FlashMessages::addMessage("❌ El nombre de la tarea no es válido", "error");
            header("Location: {$this->basePath}/tasques/create");
            exit;
        }

        // Intentar crear tarea
        if ($this->tasca->create($nom)) {
            FlashMessages::addMessage("✅ Tarea creada correctamente", "success");
        } else {
            FlashMessages::addMessage("❌ Error al crear la tarea", "error");
        }

        header("Location: {$this->basePath}/tasques"); // redirigir al listado
        exit;
    }

    // Mostrar formulario para editar tarea
    public function edit($id) {
        // Validar ID
        if (!Validator::validateId($id)) {
            FlashMessages::addMessage("❌ ID inválido", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        $tasca = $this->tasca->getById($id); // obtener tarea por ID

        // Si no existe la tarea
        if (!$tasca) {
            FlashMessages::addMessage("❌ La tarea no existe", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        require 'views/tasques/edit.php'; // cargar vista de edición
    }

    // Actualizar tarea
    public function update($id) {
        $nom = $_POST['nom'] ?? ''; // obtener nombre desde POST

        // Validar ID y nombre
        if (!Validator::validateId($id) || !Validator::validateString($nom)) {
            FlashMessages::addMessage("❌ Datos inválidos al actualizar", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        // Intentar actualizar tarea
        if ($this->tasca->update($id, $nom)) {
            FlashMessages::addMessage("✏️ Tarea actualizada con éxito", "success");
        } else {
            FlashMessages::addMessage("❌ Error al actualizar la tarea", "error");
        }

        header("Location: {$this->basePath}/tasques"); // redirigir al listado
        exit;
    }

    // Eliminar tarea
    public function delete($id) {
        // Validar ID
        if (!Validator::validateId($id)) {
            FlashMessages::addMessage("❌ ID inválido", "error");
            header("Location: {$this->basePath}/tasques");
            exit;
        }

        // Intentar eliminar tarea
        if ($this->tasca->delete($id)) {
            FlashMessages::addMessage("🗑️ Tarea eliminada correctamente", "success");
        } else {
            FlashMessages::addMessage("❌ Error al eliminar la tarea", "error");
        }

        header("Location: {$this->basePath}/tasques"); // redirigir al listado
        exit;
    }
}
