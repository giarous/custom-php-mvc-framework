<?php

namespace Core;

use Models\Router;
use Exception;
use Views\ErrorView;

/**
 * Class App
 * 
 * The main application class responsible for initializing and running the MVC framework.
 */
class App
{
    protected $router;

    /**
     * Constructor method to initialize the application.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initializes the application by loading the router.
     */
    protected function initialize()
    {
        $this->router = Router::load(__DIR__ . '/../config/routes.php');
    }

    /**
     * Runs the application by processing the current request.
     * Handles exceptions and displays error pages if necessary.
     */
    public function run()
    {
        $uri = $this->getRequestUri();
        $requestType = $this->getRequestType();

        try {
            $this->router->direct($uri, $requestType);
        } catch (Exception $e) {
            $errorView = new ErrorView();
            $errorView->displayError($e->getMessage(), 404);
            exit();
        }
    }

    /**
     * Retrieves the request URI.
     * Removes the base URL to get the relative URI.
     * 
     * @return string The relative URI of the request.
     */
    private function getRequestUri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $base_path = BaseURL;
        return preg_replace("#^$base_path/?#", '', $uri);
    }

    /**
     * Retrieves the request type (GET, POST, etc.).
     * 
     * @return string The request type.
     */
    private function getRequestType()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}

?>
