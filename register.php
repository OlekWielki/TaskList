<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleregister.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h3>Rejestracja do Task Manager</h3>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login" id="guzik">
        <p>Masz już konto? <a href = "login.php">Zaloguj<a></p>
    </form>
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