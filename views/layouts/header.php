<?php $basePath = '/mvc-tasques'; // ruta base de la aplicación ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS propio de la aplicación -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100"> <!-- flex para footer fijo -->

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= $basePath ?>/">MVC-Tasques</a> <!-- enlace a inicio -->

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $basePath ?>/tasques">Tareas</a> <!-- listado -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $basePath ?>/tasques/create">Crear Tarea</a> <!-- formulario crear -->
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container flex-fill"> <!-- contenedor principal -->

<!-- Mostrar mensajes flash si existen -->
<?php
if (class_exists('FlashMessages')) {
    FlashMessages::display(); // mostrar y limpiar mensajes de sesión
}
?>
