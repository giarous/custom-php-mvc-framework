<?php

namespace Controllers;

use Views\PagesView;

/**
 * Class PagesController
 * 
 * Controller for handling page-related actions.
 */
class PagesController
{
    /** @var PagesView $pagesView The view instance for rendering pages. */
    private $pagesView;

    /**
     * Constructor for PagesController.
     * 
     * Initializes the PagesView instance.
     */
    public function __construct()
    {
        $this->pagesView = new PagesView();
    }

    /**
     * Loads the home page.
     */
    public function home()
    {
        $this->pagesView->home();
    }

    /**
     * Loads the about page.
     */
    public function about()
    {
        $this->pagesView->about();
    }

}
