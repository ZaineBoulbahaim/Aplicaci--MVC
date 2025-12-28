<?php include 'views/layouts/header.php'; ?>

<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 text-center">
            
            <!-- Icono de error simplificado -->
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="#dc3545" viewBox="0 0 24 24">
                    <path d="M12 2L1 21h22L12 2zm0 3.5L20.5 20h-17L12 5.5z"/>
                    <path d="M11 10v5h2v-5h-2zm0 7v2h2v-2h-2z"/>
                </svg>
            </div>

            <!-- Título -->
            <h1 class="display-1 fw-bold text-danger mb-3">404</h1>
            <h2 class="h3 text-muted mb-4">Página no encontrada</h2>

            <!-- Mensaje de error -->
            <div class="alert alert-light border mb-4" role="alert">
                <p class="mb-0">Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
                <p class="mb-0">Puede que la URL haya cambiado o que hayas ingresado una dirección incorrecta.</p>
            </div>

            <!-- Botón para regresar al inicio -->
            <div class="d-grid gap-2 d-md-flex justify-content-center mt-4">
                <a href="<?= $basePath ?>/" class="btn btn-primary btn-lg px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-2">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    Volver al inicio
                </a>
                
                <!-- Botón secundario opcional para contactar soporte -->
                <?php if(isset($contactPath)): ?>
                    <a href="<?= $contactPath ?>" class="btn btn-outline-secondary btn-lg px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-2">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.708 2.825L15 11.105V5.383z"/>
                        </svg>
                        Contactar soporte
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>