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
            <a href="profile.php"><img src="profile.png" alt="profilowe"></a>
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
    <section id="taski">
        <?php
            $name = $_SESSION['login'];
            $con = new Mysqli("localhost", "root" , "", "users");
            $sql="SELECT task, date FROM tasks WHERE name='$name'";
            $wiersz = $con->query($sql);
            while($wynik = $wiersz->fetch_row()){
                echo "<p class='taskcontainer'>$wynik[0] $wynik[1]</p>";
            }
        ?>
    </section>
    <footer>
        <p>Olek & Szymon Inc.</p>
    </footer>
    <script>

    function wyswietlAlert() {
        <?php
            echo "
            var godzinaZPHP = '$date';
            var taskZPHP = '$task'; 

            ";
        ?>
    	var dzisiaj = new Date();
            function dodajZero(num) {
            return num < 10 ? '0' + num : num;
            }

        var miesiac = dzisiaj.getMonth() + 1;
        var dzien = dzisiaj.getDate();
        var godzina = dzisiaj.getHours();
        var minuta = dzisiaj.getMinutes();

        var dateandtime =
            dzisiaj.getFullYear() + '-' + dodajZero(miesiac) + '-' + dodajZero(dzien) + 'T' +
            dodajZero(godzina) + ':' + dodajZero(minuta);
            if (dateandtime === godzinaZPHP) {
                alert("wykonaj zadanie" + taskZPHP);
                console.log("jebać")
	        }
        }
        setInterval(wyswietlAlert, 1000);
    </script>
</body>
</html>