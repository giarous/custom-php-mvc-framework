<?php

namespace Controllers;

use Models\Database;
use Models\User;
use Models\UserDAO;
use Views\UsersView;
use Views\ErrorView;
use Exception;

/**
 * Class UsersController
 * 
 * Controller responsible for handling user-related actions.
 */
class UsersController
{
    private $userDAO;
    private $usersView;
    private $database;
    private $errorView;

    /**
     * UsersController constructor.
     * 
     * Initializes the UsersController with necessary dependencies.
     */
    public function __construct()
    {
        $this->database = new Database();
        $this->userDAO = new UserDAO($this->database);
        $this->usersView = new UsersView();
        $this->errorView = new ErrorView();
    }

    /**
     * Displays a list of all users.
     */
    public function index()
    {
        $this->getAllUsers();
    }

    /**
     * Retrieves all users from the database and displays them.
     * Displays an error message if fetching fails.
     */
    public function getAllUsers()
    {
        try {
            $allUsers = $this->userDAO->fetchAllUsers();
            $this->usersView->showAllUsers($allUsers);
        } catch (Exception $e) {
            $this->errorView->displayError($e->getMessage(), 500);
        }
    }

    /**
     * Creates a new user based on form input data.
     * Redirects to the user list after successful creation.
     * Displays an error message if creation fails.
     */
    public function create()
    {
        try {
            $user = new User(
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
                $_POST['name'],
                $_POST['dateOfBirth']
            );

            $this->userDAO->create($user);

            // Redirect to avoid form resubmission issues
            header("Location: /" . BaseURL . "/users");
            exit;
        } catch (Exception $e) {
            $this->errorView->displayError($e->getMessage(), 500);
        }
    }

    /**
     * Updates an existing user based on form input data.
     * Redirects to the user list after successful update.
     * Displays an error message if update fails.
     * 
     * @param array $vars The route parameters containing the user ID.
     */
    public function update($vars)
    {
        try {
            $user = new User(
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
                $_POST['name'],
                $_POST['dateOfBirth']
            );

            $user->setUserId((int)$vars['id']);

            $this->userDAO->update($user);

            // Redirect to avoid form resubmission issues
            header("Location: /" . BaseURL . "/users");
            exit;
        } catch (Exception $e) {
            $this->errorView->displayError($e->getMessage(), 500);
        }
    }

    /**
     * Deletes a user based on the provided user ID.
     * Redirects to the user list after successful deletion.
     * Displays an error message if deletion fails.
     * 
     * @param array $vars The route parameters containing the user ID.
     */
    public function delete($vars)
    {
        $userId = (int)$vars['id'];

        try {
            $this->userDAO->delete($userId);
            header("Location: /" . BaseURL . "/users");
            exit;
        } catch (Exception $e) {
            $this->errorView->displayError($e->getMessage(), 500);
        }
    }

    /**
     * Displays the form for editing a specific user.
     * Redirects to an error page if the user does not exist.
     * 
     * @param array $vars The route parameters containing the user ID.
     */
    public function editForm($vars)
    {
        $userId = (int)$vars['id'];

        try {
            $user = $this->userDAO->getUserById($userId);
            $this->usersView->showEditForm($user);
        } catch (Exception $e) {
            $this->errorView->displayError($e->getMessage(), 404);
        }
    }
}

?>
