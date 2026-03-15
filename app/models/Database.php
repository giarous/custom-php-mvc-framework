<?php

namespace Models;

use Config\Config as Config;
use Exception;
use PDO;
use PDOException;

/**
 * Class Database
 * 
 * This class handles database connections using PDO and implements the Singleton pattern.
 */
class Database
{
    private static $instance = null;
    private $pdo;

    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPass;
    private $dbConfig;

    /**
     * Constructor method.
     * 
     * Initializes the Database object with database configuration.
     */
    private function __construct()
    {
        $this->dbConfig = new Config();
        $this->dbHost = $this->dbConfig->dbHost;
        $this->dbName = $this->dbConfig->dbName;
        $this->dbUser = $this->dbConfig->dbUser;
        $this->dbPass = $this->dbConfig->dbPass;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Connects to the database using PDO.
     * 
     * @return PDO Returns a PDO object upon successful connection.
     * 
     * @throws Exception If unable to connect to the database.
     */
    public function connect()
    {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                error_log("Connection failed: " . $e->getMessage());
                throw new Exception("Unable to connect to the database.");
            }
        }
        return $this->pdo;
    }

    private function __clone() {}
    public function __wakeup() { throw new Exception("Cannot unserialize singleton."); }
    
}

?>
