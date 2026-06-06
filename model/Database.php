<?php
 
class Database {
 
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $port;
    protected $pdo; 
 
    public function __construct() {
        $this->host     = getenv('DB_HOST')     ?: 'localhost';
        $this->dbname   = getenv('DB_NAME')     ?: 'php_projet';
        $this->user     = getenv('DB_USER')     ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->port     = getenv('DB_PORT')     ?: '3306';
        $this->getConnexion();
    }
 
    private function getConnexion() {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            $this->handleError($error);
        }
 
        return $this->pdo;
    }
 
    private function handleError(PDOException $error) {
        error_log("Erreur de connexion à la BD : " . $error->getMessage());
        die("Une erreur s'est produite lors de la connexion à la base de données.");
    }
 
    // Méthode utilitaire pour exécuter des requêtes directes
    public function execSQL($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur execSQL : " . $e->getMessage());
            return false;
        }
    }
}
 
?>