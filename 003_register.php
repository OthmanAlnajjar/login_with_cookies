<?php
include "001_connection.php";                        

if(isset($_POST['submit'])){                            // Check if the form is submitted
    $name = $_POST['name'];                             // Retrieve the value of 'name' from the form
    $name = filter_var($name, FILTER_SANITIZE_STRING);   // Sanitize the 'name' input
    $email = $_POST['email'];                          
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['password'];                        
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);  
    $cpass = $_POST['cpass'];                           
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_users = $pdo->prepare("SELECT * FROM users WHERE email = ?");     // Prepare a SQL statement to check if the email already exists
    $select_users->execute([$email]);                                        // Execute the prepared statement by passing the email as the parameter
    
    if($select_users->rowCount() > 0){                       // Check if any rows are returned from the database query
        $message[] = 'Email already exists!';                 // If a row exists, add an error message to the $message array
    } else {
        if($pass != $cpass){                                  // Check if the password and confirm password do not match
            $message[]='Confirm password not matched!';       // If passwords do not match, add an error message to the $message array
        } else {
            $insert_user = $pdo->prepare("INSERT INTO users(name, email, password) VALUES (?,?,?)");   // Prepare a SQL statement to insert a new user into the database
            $insert_user->execute([$name, $email,$cpass]);     // Execute the prepared statement by passing name, email, and password as parameters

            if($insert_user){                                  // Check if the user is successfully inserted into the database
                $fetch_user = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");    // Prepare a SQL statement to fetch the user from the database
                $fetch_user->execute([$email, $cpass]);        // Execute the prepared statement by passing email and password as parameters
                $row = $fetch_user->fetch(PDO::FETCH_ASSOC);    // Fetch the user as an associative array

                if($fetch_user->rowCount() > 0){                // Check if the user is found in the database
                    setcookie('user_id', $row['id'], time()+ 60*60*24, '/');    // Set a cookie named 'user_id' with the user's ID
                    header('location:002_home.php');            // Redirect the user to the home page
                }
            }
        }
    }
}  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    

<?php
    if(isset($message)){
        foreach($message as $msg){
            echo '
                <div class="message">
                    <span>'.$msg.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
?>


<!-- Register section starts -->
<section class="form-container">
    <form action="" method="post">
        <h3>Register Now</h3>
        <input type="text" id="" placeholder="Enter your username" class="box" name="name">
        <input type="email" id="" placeholder="Enter your email" class="box" name="email">
        <input type="password" id="" placeholder="Enter your password" class="box" name="password">
        <input type="password" id="" placeholder="Confirm your password" class="box" name="cpass">
        <input type="submit" value="Register Now" class="btn" name="submit">
        <p>Already have an account? <a href="004_login.php">Login Now</a></p>
    </form>
</section>
<!-- Register section ends -->

</body>
</html>
