<?php
include "001_connection.php";                          // Include the file "001_connection.php" which contains the database connection code

if(isset($_COOKIE['user_id'])){                         // Check if the 'user_id' cookie is set
    $user_id = $_COOKIE['user_id'];                     // Retrieve the value of 'user_id' from the cookie
} else {
    $user_id = '';                                      // If 'user_id' cookie is not set, assign an empty value to $user_id
    header('location:004_login.php');                        // Redirect the user to the login page
}

$select_profile = $pdo->prepare("SELECT * FROM users WHERE id = ?");    // Prepare a SQL statement to select user profile information from the database
$select_profile->execute([$user_id]);                   // Execute the prepared statement by passing the user_id as the parameter
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);              // Fetch the profile information as an associative array

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>home</title>
</head>
<body>
    
    <div class="content">

    <div class="box">
        <h3>welcome : <span><?=$fetch_profile['name']?></span></h3>        
        <div class="flex-btn">
            <a href="004_login.php" class="btn">login</a>                  
            <a href="004_login.php" class="btn">register</a>               
        </div>
        <a href="005_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>     <!-- Display a "logout" button with confirmation dialog -->
    </div>
    </div>
    
</body>
</html>
