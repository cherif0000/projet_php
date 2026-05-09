<?php

class Database {
    private static $instance = null;

    private  $host;
    private  $dbname;
    private  $user;
    private  $password;
    protected $pdo; 

    public function __construct() {
        
            $this->host = getenv('DB_HOST') ?: 'localhost';
            $this->dbname = getenv('DB_NAME') ?: 'php_projet';
            $this->user = getenv('DB_USER') ?: 'root';
            $this->password = getenv('DB_PASSWORD') ?: '';
            $this->getConnexion();
       
    }

    private function getConnexion() 
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            $this-> handleError($error);
        }

        return $this->pdo;
    }
 
    private function handleError(PDOException $error) {
        error_log("erreur de connection a la BD. " . $error->getMessage());
        die("erreur s'est produite lors de la connection a la base de données.");
     }
       



}

?>