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
            <form method="Post">
                <input type="submit" value = "wyloguj się" name = "wyloguj">
            </form>
            <?php
                if(isset($_POST['wyloguj'])){
                    $_SESSION['login'] = "";
                    header('Location: register.php');
                }
            ?>
        </span>
    </header>
    <main>
        <form method="post" id="formmain">
            <span id="formularz">
                <Label for="zadanie">Task</Label>
                <input type="text" name="zadanie" id="zadanie" class="forms" required>
                <Label for="data">Data i czas</Label>
                <input type="datetime-local" name="data" id="data" class="forms" required>
            </span>
            <span id="przycisk">
                <input type="submit" name="submit" id="submit" class="forms">
            </span>
        </form>
        <?php 
          session_start();
          if ($_SESSION['login'] == "") {
              echo "nic nie ma";
              header('Location: register.php');
          } else {
              if (isset($_POST['submit'])) {
                  $con = new mysqli("localhost", "root", "", "users");
                  $task = $_POST['zadanie'];
                  $date = $_POST['data'];
                  $name = $_SESSION['login'];
                  
                  $currentDateTime = date('Y-m-d H:i:s');
                  if ($date < $currentDateTime) {
                      echo "<script>alert('Nie można dodać zadania z datą wcześniejszą niż dzisiejsza.');</script>";
                  } else {

                      $formattedDate = date('Y-m-d H:i:s', strtotime($date));
                      $sql = "INSERT INTO tasks (name, task, date) VALUES ('$name', '$task', '$formattedDate')";
                      $sql2 = "UPDATE profile SET task_count = task_count + 1 where task_name = '$name'";
                      $con->query($sql);
                      $con->query($sql2);
                      unset($_POST['submit']);
                      header("Location: index.php");
                  }
              }
          }
          ?>
          
          <section id="taski">
          <?php
          $name = $_SESSION['login'];
          $con = new mysqli("localhost", "root", "", "users");
          $sql = "SELECT id, task, DATE_FORMAT(date, '%Y-%m-%d %H:%i:%s') as date FROM tasks WHERE name='$name' ORDER BY date ASC";
          $wiersz = $con->query($sql);
          while ($wynik = $wiersz->fetch_assoc()) {
              echo "<form method='POST' class='wyswietl'>";
              echo "<div class='taskcontainer' id='task_$wynik[id]'>$wynik[task] $wynik[date]";
              echo "<input type='hidden' name='task_id' value='$wynik[id]'>";
              echo "<input type='submit' class='usun' name='usun' value='usun'>";
              echo "<br>";
              echo "<input type='datetime-local' name='change'>";
              echo "<input type='submit' class='zmien' name='zmien' value='zmien'>";
              echo "<input type='submit' class='zrobione' name='zrobione' value='zrobione'>";
              echo "</div><br>";
              echo "</form>";
          }
          
          if (isset($_POST['usun']) && isset($_POST['task_id'])) {
            $task_id = $_POST['task_id'];
            $name = $_SESSION['login'];
            $con->query($sql);
            $sql1 = "DELETE FROM tasks WHERE id='$task_id'";
            $con->query($sql1);
            header("Location: index.php");
          }
          if (isset($_POST['zrobione']) && isset($_POST['task_id'])) {
            $task_id = $_POST['task_id'];
            $name = $_SESSION['login'];

            $sql = "UPDATE profile SET task_done = task_done + 1 where task_name = '$name'";
            $con->query($sql);
            $sql1 = "DELETE FROM tasks WHERE id='$task_id'";
            $con->query($sql1);
            header("Location: index.php");
          }
          if (isset($_POST['zmien']) && isset($_POST['task_id']) && isset($_POST['change'])) {
              $task_id = $_POST['task_id'];
              $new_date = $_POST['change'];
              $formattedNewDate = date('Y-m-d H:i:s', strtotime($new_date));
              
              $sql = "UPDATE tasks SET date='$formattedNewDate' WHERE id='$task_id'";
              if ($con->query($sql) === TRUE) {
                  header("Location: index.php");
                  exit; 
              } else {
                  echo "<script>alert('Błąd podczas aktualizowania daty w bazie danych: " . $con->error . "');</script>";
              }
          }
          ?>
    </section>
    <footer>
        <p>Olek & Szymon Inc.</p>
    </footer>
    <script>

var zrobione = false;
function wyswietlAlert() {
    <?php
        $sql="SELECT task, date FROM tasks WHERE name='$name' ORDER BY date ASC";
        $wiersz = $con->query($sql);
        $wynik = $wiersz->fetch_row();
        
        echo "
        var godzinaZPHP = '$wynik[1]';
        var taskZPHP = '$wynik[0]'; 
        
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
        dzisiaj.getFullYear() + '-' + dodajZero(miesiac) + '-' + dodajZero(dzien) + ' ' +
        dodajZero(godzina) + ':' + dodajZero(minuta) + ":00.000000";
        
    if (zrobione == false && dateandtime === godzinaZPHP) {
        alert("wykonaj zadanie " + taskZPHP);

        zrobione = true;
    }
    console.log(dateandtime);
    console.log(godzinaZPHP);
}
setInterval(wyswietlAlert, 1000);

</script>
</body>
</html>