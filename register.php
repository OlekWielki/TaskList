<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "POST">
        <input type="text" name = "username">
        <input type="password" name = "password">
        <input type="submit">
    </form>
    <?php 
        $con = new Mysqli("localhost", "root" , "", "users");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            $sql = "INSERT INTO users (name, password) VALUES ('$username', '$hashed_password')";
        
            if (mysqli_query($con, $sql)) {
                echo "Registration successful!";
                header('Location: login.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($con);
        ?>
        <a href="login.php">Zaloguj się</a>
</body>
</html>