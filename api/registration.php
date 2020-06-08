<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<?php
    require('../includes/db.php');
    $result = 0;
    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($connect,$username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connect,$password);
        $query = "INSERT INTO users (name, password)
                VALUES ('$username', '".md5($password)."')";
        $result = mysqli_query($connect,$query);

        }
            ?>
        <form class="login" action="" method="post">
            <h1 class="login-title">Register</h1>
            <?php
            if($result){
                ?>
                <h3>You are registered successfully.</h3>
                <br/>Click here to <a href='login.php'>Login</a>";
            <?php
            }
            ?>
            <input type="text" class="login-input" name="username" placeholder="Username" required />
            <input type="password" class="login-input" name="password" placeholder="Password" required />
            <input type="submit" name="submit" value="Register" class="login-button">
            <p class="login-lost">Login here <a href="login.php">Login Here</a></p>
        </form>


</body>
</html>