<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleprofil.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Profil</h1>
    </header>
    <main>
        <div id="kontener">
            <ul>
                <?php
                session_start();
                if ($_SESSION['login'] == "") {
                    echo "nic nie ma";
                    header('Location: register.php');
                }
                else{
                    $name = $_SESSION['login'];
                    $con = new mysqli("localhost", "root", "", "users");
                    $sql = "SELECT task_done, task_count from profile where task_name = '$name';";
                    $wynik = $con->query($sql);
                    while($wiersz = $wynik->fetch_row()){
                        echo "<li>ilość wykonanych zadań: $wiersz[0] </li>";
                        echo "<li>ilość dodanych zadań: $wiersz[0] </li>";
                    }
                }
                ?>
            </ul>
        </div>
    </main>
</body>
</html>