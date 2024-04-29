<?php

namespace Models;

/**
 * Class User
 * Represents a user entity with properties and methods to manipulate user data.
 */
class User
{
    /** @var int|null The user ID. */
    private $userId;
    /** @var string The username. */
    private $username;
    /** @var string The email address. */
    private $email;
    /** @var string The user's password. */
    private $password;
    /** @var string The user's full name. */
    private $name;
    /** @var string|null The user's date of birth. */
    private $dateOfBirth;

    /**
     * Constructor.
     *
     * @param string $username The username.
     * @param string $email The email address.
     * @param string $password The user's password.
     * @param string $name The user's full name.
     * @param string|null $dateOfBirth The user's date of birth.
     */
    public function __construct($username, $email, $password, $name, $dateOfBirth = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Get the user ID.
     *
     * @return int|null Returns the user ID.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the username.
     *
     * @return string Returns the username.
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the email address.
     *
     * @return string Returns the email address.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the user's password.
     *
     * @return string Returns the user's password.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the user's full name.
     *
     * @return string Returns the user's full name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the user's date of birth.
     *
     * @return string|null Returns the user's date of birth.
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the username.
     *
     * @param string $username The username.
     * 
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set the email address.
     *
     * @param string $email The email address.
     * 
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Set the user's password.
     *
     * @param string $password The user's password.
     * 
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set the user's full name.
     *
     * @param string $name The user's full name.
     * 
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the user's date of birth.
     *
     * @param string|null $dateOfBirth The user's date of birth.
     * 
     * @return void
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Set the user ID.
     *
     * @param int $userId The user ID.
     * 
     * @return void
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
