<?php
session_start(); // iniciar sesión para usar mensajes flash

// Autocarga de clases automática
spl_autoload_register(function ($class) {
    $paths = [
        'controllers/', // controladores
        'models/',      // modelos
        'config/',      // configuraciones
        'helpers/'      // helpers (FlashMessages, Validator)
    ];

    // Buscar y cargar archivo de clase
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once 'Router.php'; // cargar Router personalizado

$router = new Router(); // crear instancia del router

/* Rutas de la aplicación */
$router->get('/', 'HomeController@index'); // página principal

$router->get('/tasques', 'TaskController@index'); // listado de tareas
$router->get('/tasques/create', 'TaskController@create'); // formulario crear
$router->post('/tasques', 'TaskController@store'); // procesar creación

$router->get('/tasques/{id}/edit', 'TaskController@edit'); // formulario editar
$router->post('/tasques/{id}', 'TaskController@update'); // procesar actualización
$router->post('/tasques/{id}/delete', 'TaskController@delete'); // eliminar tarea

/* Ejecutar router según la URL */
$router->dispatch();
