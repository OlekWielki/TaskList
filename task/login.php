<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php 
    session_start();
    $con = new Mysqli("localhost", "root" , "", "uzytkownicy");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE login='$username'";
        $result = mysqli_query($con, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = $username;
                echo "Login successful!";
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
    }
    
    mysqli_close($con);
    ?>
</body>
</html>