<?php
session_start();

// Autocarga simple de clases
spl_autoload_register(function ($class) {
    $paths = [
        'controllers/',
        'models/',
        'config/',
        'helpers/'
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once 'Router.php';

$router = new Router();

/* Rutes */
$router->get('/', 'HomeController@index');

$router->get('/tasques', 'TaskController@index');
$router->get('/tasques/create', 'TaskController@create');
$router->post('/tasques', 'TaskController@store');

$router->get('/tasques/{id}/edit', 'TaskController@edit');
$router->post('/tasques/{id}', 'TaskController@update');
$router->post('/tasques/{id}/delete', 'TaskController@delete');

/* Executar router */
$router->dispatch();
