# PHP MVC Framework

This is a lightweight PHP MVC (Model-View-Controller) framework designed to simplify web application development. It provides a structured approach to building web applications by separating concerns into distinct components: models for data handling, views for user interface presentation, and controllers for business logic and application flow.

## Features

- **MVC Architecture**: The framework follows the MVC architectural pattern to ensure separation of concerns and maintainability.
- **Routing**: Define custom routes easily to map URLs to controller actions.
- **Database Support**: Includes basic database support with PDO for handling database interactions.
- **Autoloading**: Register autoloaders to automatically load classes as needed, reducing the need for manual includes.
- **Error Handling**: Basic error handling for gracefully handling exceptions and errors.
- **Configurability**: Utilize environment configuration files (e.g., .env) for managing environment-specific settings.
- **Customizable**: Easily extend or customize the framework to suit specific project requirements.

## Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/giarous/custom-php-mvc-framework.git

2. Configure your web server to point to the public directory as the document root.
3. Rename the .env.example file to .env and update the database and base URL configurations as needed.

## Usage

1. Define your routes in the app/config/routes.php file to map URLs to controller actions.
2. Create controller classes in the app/controllers directory to handle specific actions and business logic.
3. Define model classes in the app/models directory to interact with the database and manage application data.
4. Create view files in the app/views directory to render HTML output for user interfaces.
5. Customize the framework as needed for your specific project requirements.

## Contributing
Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.
