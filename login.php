<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <form method="post">
        <h3>Logowanie do Task Manager</h3>
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
    
        $sql = "SELECT * FROM users WHERE name='$username'";
        $result = mysqli_query($con, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = $username;
                echo "Login successful!";
                header('Location: index.php');
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