<?php
/**
 * Autoloader function for PHP classes.
 *
 * This function automatically includes PHP class files based on their namespace and class name.
 * It follows the PSR-4 standard for autoloading PHP classes.
 *
 * @param string $className The fully qualified class name (including namespace).
 * @return bool True if the class file was successfully included, false otherwise.
 */
function myAutoloader($className)
{
    // Convert namespace separator (\) to directory separator (/)
    $path = str_replace('\\', '/', $className);

    // Base directory where PHP class files are located (relative to this file)
    $baseDir = __DIR__ . '/../';
    
    // File extension for PHP class files
    $extension = ".php";
    
    // Full path to the PHP class file
    $fullPath = $baseDir . $path . $extension;

    // Check if the class file exists
    if (!file_exists($fullPath)) {
        return false;
    }

    // Include the class file
    include_once $fullPath;

    // Return true to indicate successful inclusion of the class file
    return true;
}

// Register the autoloader function
spl_autoload_register('myAutoloader');
