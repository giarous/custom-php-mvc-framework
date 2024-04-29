<?php

namespace Models;

use Exception;
use PDOException;

/**
 * Class UserDAO
 * 
 * Data Access Object (DAO) for interacting with the User entity in the database.
 */
class UserDAO
{
    /** @var PDO An instance of PDO for database connection */
    private $pdo;

    /**
     * UserDAO constructor.
     * 
     * @param Database $database An instance of Database for database connection.
     */
    public function __construct(Database $database)
    {
        $this->pdo = $database->connect();
    }

    /**
     * Create a new User.
     * 
     * @param User $user The User object to be created.
     * @return User The User object with the assigned ID after creation.
     * @throws Exception If a database error occurs during creation.
     */
    public function create(User $user)
    {
        // SQL query to insert a new user record into the database
        $query = "INSERT INTO users (username, email, password, name,  date_of_birth) VALUES (:username, :email, :password, :name, :dateOfBirth)";
        
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($query);

            // Bind values to parameters
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':dateOfBirth', $user->getDateOfBirth());

            // Execute the SQL statement
            $stmt->execute();

            // Set the user's ID with the last inserted ID
            $user->setUserId($this->pdo->lastInsertId());

            // Return the User object
            return $user;
        } catch (PDOException $e) {
            // Log the error
            error_log("Failed to create new user: " . $e->getMessage());

            // Throw an exception with a generic message
            throw new Exception("Database issue: Failed to create new User.");
        }
    }

    /**
     * Retrieve a User by ID.
     * 
     * @param int $userId The ID of the User to retrieve.
     * @return User The retrieved User object.
     * @throws Exception If no user is found with the given ID or a database error occurs.
     */
    public function getUserById($userId)
    {
        try {
            // Prepare SQL query to select user by ID
            $query = "SELECT * FROM users WHERE id = :userId";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':userId', $userId);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $row = $stmt->fetch();

            // Check if a user was found
            if (!$row) {
                throw new Exception("No user found with the ID: $userId");
            }

            // Create a User object from the database result
            $user = new User(
                $row['username'],
                $row['email'],
                $row['password'],
                $row['name'],
                $row['date_of_birth']
            );

            // Set the user ID
            $user->setUserId($row['id']);

            // Return the User object
            return $user;

        } catch (PDOException $e) {
            // Log error and throw exception
            error_log('Failed to get user: ' . $e->getMessage());
            throw new Exception("Database issue: Failed to get User.");
        }
    }


    /**
     * Update an existing User in the database.
     * 
     * @param User $user The User object containing updated information.
     * @return bool True on successful update, false otherwise.
     * @throws Exception If a database error occurs.
     */
    public function update(User $user)
    {
        // Prepare SQL query to update user information
        $query = "UPDATE users SET username = :username, email = :email, password = :password, name = :name, date_of_birth = :dateOfBirth WHERE id = :userId";
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($query);

            // Bind values to parameters
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':dateOfBirth', $user->getDateOfBirth());
            $stmt->bindValue(':userId', $user->getUserId());

            // Execute the update query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error and throw exception
            error_log("Failed to update user: " . $e->getMessage());
            throw new Exception("Database issue: Failed to update User.");
        }
    }


    /**
     * Delete a User from the database.
     * 
     * @param int $userId The ID of the User to delete.
     * @return bool True on successful deletion, false otherwise.
     * @throws Exception If a database error occurs.
     */
    public function delete(int $userId)
    {
        // SQL query to delete a user by ID
        $query = "DELETE FROM users WHERE id = :userId";

        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($query);
            
            // Bind the user ID parameter
            $stmt->bindValue(':userId', $userId);
            
            // Execute the delete query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error and throw exception
            error_log("Failed to delete user: " . $e->getMessage());
            throw new Exception("Database issue. Failed to delete User.");
        }
    }


    /**
     * Fetch all users from the database.
     * 
     * @return array An array of User objects representing all users in the database.
     * @throws Exception If a database error occurs.
     */
    public function fetchAllUsers()
    {
        // SQL query to select all users
        $query = "SELECT * FROM users";

        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($query);
            
            // Execute the query
            $stmt->execute();
            
            // Initialize an empty array to store User objects
            $users = [];

            // Fetch each row from the result set
            while ($row = $stmt->fetch()) {
                // Create a new User object with data from the current row
                $user = new User(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['name'],
                    $row['date_of_birth']
                );

                // Set the user ID
                $user->setUserId($row['id']);

                // Add the User object to the array
                $users[] = $user;
            }

            // Return the array of User objects
            return $users;
        } catch (PDOException $e) {
            // Log error and throw exception
            error_log("Failed to fetch all users: " . $e->getMessage());
            throw new Exception("Database issue: Failed to fetch all Users.");
        }
    }

}

