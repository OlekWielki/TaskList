<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
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
        <form method="post">
            <span id="formularz">
                <Label for="zadanie">Task</Label><br>
                <input type="text" name="zadanie" id="zadanie" required><br>
                <Label for="data">Data i czas</Label><br>
                <input type="datetime-local" name="data" id="data" required><br>
            </span>
            <span id="przycisk">
                <input type="submit" name="submit" id="submit">
            </span>
        </form>
        <?php
            session_start();
            
            if($_SESSION['login']==""){
                echo "nic nie ma";
                header('Location: register.php');
            }
            else{
                echo $_SESSION['login'];
                if(isset($_POST['submit'])){
                    $con = new Mysqli("localhost", "root" , "", "users");
                    $task = $_POST['zadanie'];
                    $date = $_POST['data'];
                    $name = $_SESSION['login'];
                    $sql="INSERT INTO tasks VALUES('','$name','$task','$date')";
                    $con->query($sql);
                }
            }
        ?>
    </main>
    <section>
        <?php
            $con = new Mysqli("localhost", "root" , "", "users");
            $sql="SELECT task, date FROM tasks WHERE name='$name'";
            $wiersz = $con->query($sql);
            while($wynik = $wiersz->fetch_row()){
                echo "$wynik[0] $wynik[1] <br>";
            }
        ?>
    </section>
    <footer>
        <p>Olek & Szymon Inc.</p>
    </footer>
</body>
</html>