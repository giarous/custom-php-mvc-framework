<?php

namespace Views;

/**
 * Class ErrorView
 * 
 * A class responsible for displaying error messages.
 */
class ErrorView
{
    /**
     * Display an error message along with an optional error code.
     *
     * @param string $message The error message to display.
     * @param int $errorCode (Optional) The HTTP error code (default is 500).
     * @return void
     */
    public function displayError($message, $errorCode = 500)
    {
        // Include the header partial
        require('partials/header.php');
        
        // Set the HTTP response code
        http_response_code($errorCode);
?>
        <!-- Error container with error message and return link -->
        <div class="error-container">
            <h1>An Error Occurred</h1>
            <p><?php echo htmlspecialchars($message); ?></p>
            <a class="button-like" href="/<?=BaseURL?>">Return to Home</a>
        </div>
<?php
        // Include the footer partial
        require('partials/footer.php');
    }
}
