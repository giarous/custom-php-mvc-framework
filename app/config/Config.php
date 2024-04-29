<?php

namespace Config;

/**
 * Class Config
 * 
 * Configuration class responsible for loading database credentials from the .env file.
 */
class Config 
{	
    /** @var array $dbCreds The array containing database credentials */
	public $dbCreds;
	
    /** @var string $dbHost The database host */
	public $dbHost;
	
    /** @var string $dbName The database name */
    public $dbName;
    
    /** @var string $dbUser The database username */
    public $dbUser;
    
    /** @var string $dbPass The database password */
    public $dbPass;

    // Uncomment the following lines if $baseURL is used
    // /** @var string $baseURL The base URL of the application */
	// public $baseURL;
	
    /**
     * Constructor method to initialize the Config object.
     */
	function __construct() {
        // Load database credentials from .env file
		$this->dbCreds = parse_ini_file('.env', true);
        
        // Assign database credentials to class properties
        $this->dbHost = $this->dbCreds["DB_HOST"];
        $this->dbName = $this->dbCreds["DB_NAME"];
        $this->dbUser = $this->dbCreds["DB_USER"];
        $this->dbPass = $this->dbCreds["DB_PASSWORD"];

        // Uncomment the following line if $baseURL is used
        // $this->baseURL = $this->dbCreds["BASE_URL"];
	}
}

?>
