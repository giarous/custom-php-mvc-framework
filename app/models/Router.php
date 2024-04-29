<?php

namespace Models;

use Exception;

/**
 * Router class for routing requests to appropriate controller actions.
 */
class Router {
    /**
     * Array to store routes for GET and POST requests.
     * 
     * @var array
     */
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Loads routes from a file and returns a Router instance.
     * 
     * @param string $file The file containing route definitions.
     * 
     * @return Router Returns a Router instance.
     */
    public static function load($file) {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * Defines a route for GET requests.
     * 
     * @param string $uri The URI pattern.
     * @param string $controller The controller and method to call.
     * 
     * @return void
     */
    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Defines a route for POST requests.
     * 
     * @param string $uri The URI pattern.
     * @param string $controller The controller and method to call.
     * 
     * @return void
     */
    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Directs the request to the appropriate controller action.
     * 
     * @param string $uri The request URI.
     * @param string $requestType The request type (GET or POST).
     * 
     * @throws Exception If no route is defined for the URI.
     * 
     * @return mixed Returns the result of the controller action.
     */
    public function direct($uri, $requestType) {
        if (!array_key_exists($uri, $this->routes[$requestType])) {
            return $this->handleDynamicRoutes($uri, $requestType);
        }
        return $this->callAction(
            ...explode('@', $this->routes[$requestType][$uri])
        );
    }

    /**
     * Handles dynamic routes by matching patterns and extracting parameters.
     * 
     * @param string $uri The request URI.
     * @param string $requestType The request type (GET or POST).
     * 
     * @throws Exception If no matching route is found.
     * 
     * @return mixed Returns the result of the controller action.
     */
    protected function handleDynamicRoutes($uri, $requestType) {
        foreach ($this->routes[$requestType] as $route => $action) {
            $pattern = $this->convertToRegex($route);
            if (preg_match($pattern, $uri, $matches)) {
                $params = $this->extractNamedParams($matches);
                list($controller, $method) = explode('@', $action);
                return $this->callAction($controller, $method, $params);
            }
        }
        throw new Exception('No route defined for this URI.');
    }

    /**
     * Converts a route pattern to a regular expression.
     * 
     * @param string $route The route pattern.
     * 
     * @return string Returns the regular expression pattern.
     */
    protected function convertToRegex($route) {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([^}]+)\}/', '(?P<$1>[^\/]+)', $route);
        return "/^$route$/";
    }

    /**
     * Extracts named parameters from the matched route.
     * 
     * @param array $matches The matches from the route pattern.
     * 
     * @return array Returns the named parameters.
     */
    protected function extractNamedParams($matches) {
        return array_filter(
            $matches,
            function ($key) {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Calls the controller action.
     * 
     * @param string $controller The controller class name.
     * @param string $action The controller action method.
     * @param array $vars The parameters to pass to the action.
     * 
     * @throws Exception If the controller or action does not exist.
     * 
     * @return mixed Returns the result of the controller action.
     */
    protected function callAction($controller, $action, $vars = []) {
        $controller = "\Controllers\\{$controller}";
        $controller = new $controller;
        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action($vars);
    }
}
