<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleregister.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div id="tlo">
<div id="login">
    <form method = "POST">

        <h1>REJESTRACJA</h1><br>
        <Label for="username">Username</Label>
        <input type="text" name = "username">
        <Label for = "password">password</Label>
        <input type="password" name = "password">
        <input type="submit">
    </form>
</div></div>
    
    <p>Masz już konto? <a href = "login.php">Zaloguj<a></p>
    <?php 
        session_start();
        $con = new Mysqli("localhost", "root" , "", "users");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            $sql = "INSERT INTO users (name, password) VALUES ('$username', '$hashed_password')";
        
            if ($con->query($sql)) {
                echo "Registration successful!";
                $_SESSION['login'] = $username;
                header('Location: index.php');
            }
        }
        
        mysqli_close($con);
        ?>
</body>
</html>
