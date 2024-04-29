<?php

// Define the root project directory used for navigation and routing
define('BaseURL', 'custom-php-mvc-framework');

// Include the autoloader file to automatically load class files
include __DIR__ . '/../app/config/autoloader.php';

// Create an instance of the App class from the Core namespace
$app = new Core\App();

// Run the application
$app->run();
