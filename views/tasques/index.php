<?php include 'views/layouts/header.php'; // incluir header con navbar y mensajes flash ?>

<h1 class="mb-4">Lista de Tareas</h1>

<!-- Breadcrumb para navegación -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= $basePath ?>/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tareas</li>
  </ol>
</nav>

<?php if (empty($tasques)): ?>
    <!-- Mensaje cuando no hay tareas -->
    <div class="alert alert-info">No hay tareas disponibles.</div>
<?php else: ?>
    <!-- Tabla de tareas -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasques as $tasca): ?>
                <tr>
                    <td><?= htmlspecialchars($tasca['id']) ?></td> <!-- mostrar ID -->
                    <td><?= htmlspecialchars($tasca['nom']) ?></td> <!-- mostrar nombre -->

                    <td>
                        <!-- Botón editar -->
                        <a href="<?= $basePath ?>/tasques/<?= $tasca['id'] ?>/edit" class="btn btn-primary btn-sm">Editar</a>

                        <!-- Formulario eliminar con confirmación JS -->
                        <form action="<?= $basePath ?>/tasques/<?= $tasca['id'] ?>/delete" method="post" style="display:inline;" onsubmit="return confirmDelete();">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Función JS para confirmar eliminación -->
<script>
function confirmDelete() {
    return confirm('⚠️ ¿Estás seguro que quieres eliminar esta tarea?');
}
</script>

<?php include 'views/layouts/footer.php'; // incluir footer fijo y scripts de Bootstrap ?>
