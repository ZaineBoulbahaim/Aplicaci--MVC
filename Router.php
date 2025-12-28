<?php

class Router {
    private $routes = []; // almacenar rutas registradas

    // Registrar ruta GET
    public function get($path, $action) {
        $this->routes['GET'][] = ['path' => $path, 'action' => $action];
    }

    // Registrar ruta POST
    public function post($path, $action) {
        $this->routes['POST'][] = ['path' => $path, 'action' => $action];
    }

    // Ejecutar la ruta correspondiente según la URL actual
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD']; // método HTTP actual
        $uri = $_SERVER['REQUEST_URI']; // URL solicitada

        // Limpiar query string
        $uri = parse_url($uri, PHP_URL_PATH);

        // BasePath forzado si el proyecto no está en raíz
        $basePath = '/mvc-tasques';
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Asegurarse que la URI siempre empieza con /
        if (empty($uri)) {
            $uri = '/';
        } elseif ($uri[0] !== '/') {
            $uri = '/' . $uri;
        }

        $routes = $this->routes[$method] ?? []; // obtener rutas según método

        // Buscar coincidencia con las rutas registradas
        foreach ($routes as $route) {
            // Convertir ruta con parámetros {id} en expresión regular
            $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // quitar coincidencia completa
                $this->executeAction($route['action'], $matches); // ejecutar acción
                return;
            }
        }

        // Ruta no encontrada
        http_response_code(404);
        if (class_exists('HomeController')) {
            $controller = new HomeController();
            $controller->notFound(); // mostrar 404
        } else {
            echo "404 - Página no encontrada";
        }
    }

    // Ejecutar acción del controlador
    private function executeAction($action, $params = []) {
        [$controllerName, $method] = explode('@', $action); // separar controlador y método

        // Verificar existencia de controlador
        if (!class_exists($controllerName)) {
            echo "Controlador $controllerName no encontrado";
            return;
        }

        $controller = new $controllerName();

        // Verificar existencia del método
        if (!method_exists($controller, $method)) {
            echo "Método $method no encontrado en $controllerName";
            return;
        }

        // Llamar método con parámetros
        call_user_func_array([$controller, $method], $params);
    }
}
