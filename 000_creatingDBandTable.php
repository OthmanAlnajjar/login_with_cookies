<?php

try {
    $pdo = new PDO("mysql:host=localhost","root","",[                // Connect to MySQL without specifying a database
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION    
    ]);

    // Create the "login_db" database if it doesn't exist
    $dbName = "login_db";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName");

    // Switch to the "login_db" database
    $pdo->exec("USE $dbName");
}
catch(PDOException $php_errormsg) {                                 // Handle any exceptions that occur during database connection
    echo "Problems with the database.<br>";
    echo $php_errormsg;                                             // Output the error message (for development purposes)
    die();                                                          // Terminate the script in case of an error
}

$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)");

echo "Database and table created successfully!";
