<?php
include "001_connection.php";

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['password'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_users = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $select_users->execute([$email, $pass]);
    $row = $select_users->fetch(PDO::FETCH_ASSOC);
    
    if($select_users->rowCount() > 0){
        setcookie('user_id', $row['id'], time()+ 60*60*24, '/');
        header('location:002_home.php');
    }else{
        $message[]='inncorrect email or password!';
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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

<!--Register section starts -->
    <section class="form-container">
        
        <form action="" method="post">
            <h3>login now</h3>
            <input type="email"  id="" placeholder="enter your email" class="box" name="email">
            <input type="password" id="" placeholder="enter your password" class="box" name="password">
            <input type="submit" value="login now" class="btn" name="submit">
            <p>don't have an account <a href="003_register.php">register now</a></p>

        </form>

    </section>

<!--Register section ends -->

</body>
</html>