<?php
/**
 * Database - Connexion à la base de données
 * Pattern Singleton : une seule connexion partagée
 */
class Database {
    private static $instance = null;

    private string $host     = 'localhost';
    private string $dbname   = 'php_projet';
    private string $user     = 'root';
    private string $password = ''; 

    private PDO $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("❌ Erreur de connexion : " . $e->getMessage());
        }
    }

    // Retourne toujours la même instance
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
