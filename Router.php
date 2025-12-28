<?php

class Router {
    private $routes = [];

    // Registrar ruta GET
    public function get($path, $action) {
        $this->routes['GET'][] = ['path' => $path, 'action' => $action];
    }

    // Registrar ruta POST
    public function post($path, $action) {
        $this->routes['POST'][] = ['path' => $path, 'action' => $action];
    }

    // Ejecutar ruta según URL actual
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Limpiar query string
        $uri = parse_url($uri, PHP_URL_PATH);

        // BasePath forzado
        $basePath = '/mvc-tasques';
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Asegurarse que siempre empieza con /
        if (empty($uri)) {
            $uri = '/';
        } elseif ($uri[0] !== '/') {
            $uri = '/' . $uri;
        }

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {
            $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // quitar coincidencia completa
                $this->executeAction($route['action'], $matches);
                return;
            }
        }

        // Ruta no encontrada
        http_response_code(404);
        if (class_exists('HomeController')) {
            $controller = new HomeController();
            $controller->notFound();
        } else {
            echo "404 - Página no encontrada";
        }
    }

    private function executeAction($action, $params = []) {
        [$controllerName, $method] = explode('@', $action);
        if (!class_exists($controllerName)) {
            echo "Controlador $controllerName no encontrado";
            return;
        }
        $controller = new $controllerName();
        if (!method_exists($controller, $method)) {
            echo "Método $method no encontrado en $controllerName";
            return;
        }
        call_user_func_array([$controller, $method], $params);
    }
}
