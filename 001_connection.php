<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=login_db", "root", "", [         // Connect to the MySQL server and select the "login_db" database
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);


}
catch(PDOException $php_errormsg) {                                 // Handle any exceptions that occur during database connection
    echo "Problems with the database.<br>";
    echo $php_errormsg;                                             // Output the error message (for development purposes)
    die();                                                          // Terminate the script in case of an error
}



?>
