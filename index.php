<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();    
        if($_SESSION['login']==""){
            echo "nic nie ma";
            header('Location: register.php');
        }
        else{
            echo $_SESSION['login'];
        }
    ?>
    <header>
        <h1>Task Manager</h1>
        <span id="login">
            <form action="login.php">
                <input type="submit" value="Zaloguj się" id="zaloguj" name="zaloguj"/>
            </form>
            <form action="register.php">
                <input type="submit" value="Zarejestruj się" id="rejestruj" name="rejsetruj"/>
            </form>
        </span>
    </header>
    <main>
        <form method="POST">
            <span id="formularz">
                <Label for="zadanie">Task</Label><br>
                <input type="text" name="zadanie" id="zadanie" required><br>
                <Label for="data">Data i czas</Label><br>
                <input type="datetime-local" name="data" id="data" required><br>
            </span>
            <span id="przycisk">
                <input type="submit" name="submit" id="button">
            </span>
        </form>
        <?php
            $con = new Mysqli("localhost", "root" , "", "users");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $task = $_POST["zadanie"];
                $date = $_POST["data"];
                echo $date;
                $name = $_SESSION['login'];
                $sql = "SELECT id, users.name FROM users WHERE users.name = '$name'";
                $wyniksql = $con->query($sql);
                $row = mysqli_fetch_row($wyniksql);
                $sql2 = "INSERT INTO tasks VALUES('','$row[0]','$task','$date')";
                $con->query($sql2);
                $sql3="SELECT CAST(data as DATETIME(0)) FROM tasks WHERE id = 10";
                $wyniksql = $con->query($sql3);
                $row = mysqli_fetch_row($wyniksql);
                echo $row[0];
            }
        ?>
    </main>
    <section>
        <?php
            
        ?>
    </section>
    <footer>
        <p>Olek & Szymon Inc.</p>
    </footer>
</body>
</html>