<?php

namespace Views;

/**
 * Class UsersView
 * 
 * A class responsible for rendering views related to User.
 */
class UsersView
{
    /**
     * Render the view to display all users.
     *
     * This method generates HTML markup to display a table containing information about all users.
     * Each row in the table represents a user and includes columns for User ID, Username, Email, Name, Date of Birth,
     * Edit button (to edit user details), and Delete button (to delete the user).
     * Additionally, the method renders a form to create a new user above the table.
     *
     * @param array $allUsers An array containing all user objects
     * @return void
     */
    public function showAllUsers($allUsers)
    {
        // Include the header
        require('partials/header.php');
?>
        <h1>Users Page</h1>

        <!-- Display the form to create a new user -->
        <?php $this->showCreateUserForm(); ?>

        <!-- Display all users in a table -->
        <table class="table-bordered">
            <thead>
                <tr>
                    <th colspan="7" class="table-header">ALL USERS</th>
                </tr>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user) : ?>
                    <tr>
                        <!-- Display user details in table cells -->
                        <td><?php echo htmlspecialchars($user->getUserId()); ?></td>
                        <td><?php echo htmlspecialchars($user->getUsername()); ?></td>
                        <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                        <td><?php echo htmlspecialchars($user->getName()); ?></td>
                        <td><?php echo htmlspecialchars($user->getDateOfBirth()); ?></td>
                        <!-- Link to edit user details -->
                        <td><a href="users/edit/<?php echo htmlspecialchars($user->getUserId()); ?>" class="button">Edit</a></td>
                        <!-- Form to delete user -->
                        <td>
                            <form action="users/delete/<?php echo $user->getUserId(); ?>" method="POST">
                                <input type="submit" value="Delete" class="button" onclick="return confirm('Are you sure?');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php
        // Include the footer
        require('partials/footer.php');
    }


    /**
     * Render the form to edit a user.
     *
     * This method generates HTML markup for a form allowing the editing of user details.
     * The form includes input fields for username, email, password, name, and date of birth.
     * Upon submission, the form sends a POST request to update the user's details.
     *
     * @param User $user The user object to be edited
     * @return void
     */
    public function showEditForm($user)
    {
        // Include the header
        require('partials/header.php');
    ?>
        <h2>Edit User</h2>

        <!-- Display the form to edit user details -->
        <form action="/<?= BaseURL ?>/users/update/<?php echo $user->getUserId(); ?>" method="post">
            <div>
                <label for="userId">User ID:</label>
                <input type="text" id="userId" name="userId" value="<?php echo $user->getUserId(); ?>" readonly required>
            </div>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user->getUsername()); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user->getName()); ?>" required>
            </div>
            <div>
                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo htmlspecialchars($user->getDateOfBirth()); ?>">
            </div>
            <button type="submit">Save Changes</button>
        </form>
        <a href="/<?=BaseURL?>/users" class="button-like-cancel">Cancel and go back</a>
    <?php

        // Include the footer
        require('partials/footer.php');
    }

    /**
     * Render the form to create a new user.
     *
     * This method generates HTML markup for a form allowing the creation of a new user.
     * The form includes input fields for username, email, password, name, and date of birth.
     * Upon submission, the form sends a POST request to the '/users/create/' endpoint.
     *
     * @return void
     */
    public function showCreateUserForm()
    {
    ?>
        <!-- Display the form to create a new user -->
        <table class="table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="table-header">CREATE NEW USER</th>
                </tr>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="/<?=BaseURL?>/users/create/" method="post">
                        <td><input type="text" id="username" name="username" required></td>
                        <td><input type="email" id="email" name="email" required></td>
                        <td><input type="password" id="password" name="password" required></td>
                        <td><input type="text" id="name" name="name" required></td>
                        <td><input type="date" id="dateOfBirth" name="dateOfBirth"></td>
                        <td><input type="submit" value="Create New User" class="button"></td>
                    </form>
                </tr>
            </tbody>
        </table>
<?php
    }
}
