<?php include 'views/layouts/header.php'; // incluir header con navbar y mensajes flash ?>

<h1 class="mb-4">Editar Tarea</h1>

<!-- Breadcrumb para navegación -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= $basePath ?>/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= $basePath ?>/tasques">Tareas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
  </ol>
</nav>

<!-- Formulario para editar tarea existente -->
<form action="<?= $basePath ?>/tasques/<?= $tasca['id'] ?>" method="post">
    <div class="mb-3">
        <label for="nom" class="form-label">Nombre de la tarea</label>
        <!-- Input con valor actual de la tarea -->
        <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($tasca['nom']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button> <!-- enviar formulario -->
</form>

<?php include 'views/layouts/footer.php'; // incluir footer fijo y scripts de Bootstrap ?>
