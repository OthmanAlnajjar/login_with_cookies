<?php
include "001_connection.php";
setcookie('user_id','', time()-1, '/');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>logout</title>
</head>
<body>
    
    <div class="content">

    <div class="box">
        <h3>logged out successfully</h3>
        <div class="flex-btn">
            <a href="004_login.php" class="btn">login</a>
            <a href="004_login.php" class="btn">register</a>
        </div>
    </div>
    
</body>
</html>