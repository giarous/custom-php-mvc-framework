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
    public function __construct()
    {
        $this->dbConfig = new Config();
        $this->dbHost = $this->dbConfig->dbHost;
        $this->dbName = $this->dbConfig->dbName;
        $this->dbUser = $this->dbConfig->dbUser;
        $this->dbPass = $this->dbConfig->dbPass;
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
        try {
            $pdo = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);

            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set default fetch mode to associative array
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            // Log error to file or error monitoring system
            error_log("Connection failed: " . $e->getMessage());

            // Show a generic error message
            throw new Exception("Unable to connect to the database. Please try again later.");
        }
    }
    
}

?>
