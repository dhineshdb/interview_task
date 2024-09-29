Steps to run the application
----------------------------

1) First make sure you created the database called 'registration' and then create a 'users' table with the following query:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

2) Then run the 'index.php' file for the 'registration' form
