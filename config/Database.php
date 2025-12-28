<?php

class Database {
    // Instancia única para el patrón Singleton
    private static $instance = null;
    private $pdo; // objeto PDO

    // Configuración de la base de datos
    private $host = 'localhost';
    private $db   = 'mvc-tasques';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    // Constructor privado para evitar instanciación externa
    private function __construct() {
        // DSN de conexión a MySQL
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        
        // Opciones de PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanzar excepciones en errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // resultados como array asociativo
            PDO::ATTR_EMULATE_PREPARES => false, // usar sentencias preparadas nativas
        ];

        // Intentar conectar a la base de datos
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // Terminar ejecución si hay error
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Obtener la instancia única del Singleton
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self(); // crear instancia si no existe
        }
        return self::$instance;
    }

    // Obtener la conexión PDO para usar en modelos
    public function getConnection() {
        return $this->pdo;
    }
}
