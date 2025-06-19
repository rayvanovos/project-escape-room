<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen of Registreren</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welkom bij de Escape Room</h1>

        <!-- Toon eventuele berichten uit de URL -->
        <?php
        if (isset($_GET['msg'])) {
            echo '<p style="color:white;">' . htmlspecialchars($_GET['msg']) . '</p>';
        }
        ?>

        <!-- Inlogformulier -->
        <form id="login-form" action="verwerk.php" method="post">
            <input type="hidden" name="actie" value="login">
            <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam of e-mail" required>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <button type="submit">Inloggen</button>
        </form>

        <!-- Registratieformulier -->
        <form id="register-form" action="verwerk.php" method="post" style="display:none;">
            <input type="hidden" name="actie" value="registratie">
            <input type="text" name="gebruikersnaam" placeholder="Kies een gebruikersnaam" required>
            <input type="email" name="email" placeholder="Voer je e-mailadres in" required>
            <input type="password" name="wachtwoord" placeholder="Kies een wachtwoord" required>
            <button type="submit">Registreren</button>
        </form>

        <p id="login-link">Nog geen account? <a href="#" onclick="toggleForms('register')">Registreren</a></p>
        <p id="register-link" style="display:none;">Al een account? <a href="#" onclick="toggleForms('login')">Inloggen</a></p>
    </div>

    <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-image: url("images/login.avif");
      background-size: cover;
    }
    #toggle-form,a{
      color: white;
    }
    </style>
    <script>
    function toggleForms(form) {
        if (form === 'register') {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
            document.getElementById('login-link').style.display = 'none';
            document.getElementById('register-link').style.display = 'block';
        } else {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('login-link').style.display = 'block';
            document.getElementById('register-link').style.display = 'none';
        }
    }
    </script>
</body>
</html>