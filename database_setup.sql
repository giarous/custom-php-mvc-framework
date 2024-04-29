CREATE DATABASE IF NOT EXISTS custom_framework;

USE custom_framework;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL
);

INSERT INTO users (username, email, password, first_name, last_name, date_of_birth) VALUES
('user1', 'user1@example.com', 'password1', 'John', 'Doe', '1990-01-01'),
('user2', 'user2@example.com', 'password2', 'Jane', 'Smith', '1992-05-15'),
('user3', 'user3@example.com', 'password3', 'Michael', 'Johnson', '1985-11-30'),
('user4', 'user4@example.com', 'password4', 'Emily', 'Brown', '1988-09-20'),
('user5', 'user5@example.com', 'password5', 'David', 'Wilson', '1995-03-10'),
('user6', 'user6@example.com', 'password6', 'Sarah', 'Martinez', '1993-07-25'),
('user7', 'user7@example.com', 'password7', 'Christopher', 'Taylor', '1987-12-05'),
('user8', 'user8@example.com', 'password8', 'Amanda', 'Anderson', '1991-06-18'),
('user9', 'user9@example.com', 'password9', 'Matthew', 'Thomas', '1989-04-12'),
('user10', 'user10@example.com', 'password10', 'Laura', 'Garcia', '1994-08-22');

