<?php

namespace Views;

/**
 * Class PagesView
 * 
 * A class responsible for rendering pages related to the site's pages.
 */
class PagesView
{
    /**
     * Render the home page.
     *
     * @return void
     */
    public function home()
    {
        // Include the header
        require('partials/header.php');
        
        // Output the home page content
        echo "<h1>Home Page</h1>";
        echo "<h2>Welcome to my Custom PHP MVC Framework</h2>";

        // Include the footer
        require('partials/footer.php');
    }

    /**
     * Render the about page.
     *
     * @return void
     */
    public function about()
    {
        // Include the header
        require('partials/header.php');
        
        // Output the about page content
        echo "<h1>About Page</h1>";
        echo "<h2>This is About Page</h2>";

        // Include the footer
        require('partials/footer.php');
    }
}
