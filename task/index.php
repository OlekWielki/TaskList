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
        <form metohd="POST">
            <span id="formularz">
                <Label for="zadanie">Task</Label><br>
                <input type="text" name="zadanie" required><br>
                <Label for="data">Data i czas</Label><br>
                <input type="datetime-local" name="data" required><br>
            </span>
            <span id="przycisk">
                <input type="submit" name="submit" id="button">
            </span>
        </form>
    </main>
    <footer>
        <p>Olek & Szymon Inc.</p>
    </footer>
</body>
</html>
