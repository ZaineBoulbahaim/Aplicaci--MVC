<?php

class HomeController {
    public function index() {
        // Cargar la vista de inicio
        include 'views/home/index.php';
    }

    public function notFound() {
        // Cargar vista 404
        include 'views/home/404.php';
    }
}
