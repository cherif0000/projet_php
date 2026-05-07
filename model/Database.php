<?php

class Database {
    private static $instance = null;

    private  $host;
    private  $dbname;
    private  $user;
    private  $password;
    private  $db; 

    private function __construct() {
        
            $this->host = gotenv('DB_HOST') ?: 'localhost';
            $this->dbname = gotenv('DB_NAME') ?: 'php_projet';
            $this->user = gotenv('DB_USER') ?: 'root';
            $this->password = gotenv('DB_PASSWORD') ?: '';
            $this->getConnexion();
       
    }

    private function getConnexion() 
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        try {
            $this->db = new PDO($dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            $this-> handleError($error);
        }

        return $this->db;
    }
 
    private function handleError(PDOeXEPTION $error) {
        error_log("erreur de connection a la BD. " . $error->getMessage());
        die("erreur s'est produite lors de la connection a la base de données.");
     }
       



}

?>


