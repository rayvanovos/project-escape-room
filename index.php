<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Escape Room</h1>

        <!-- Show any messages from the URL -->
        <?php
        if (isset($_GET['msg'])) {
            echo '<p style="color:white;">' . htmlspecialchars($_GET['msg']) . '</p>';
        }
        ?>

        <!-- Login form -->
        <form id="login-form" action="verwerk.php" method="post">
            <input type="hidden" name="actie" value="login">
            <input type="text" name="gebruikersnaam" placeholder="Username or email" required>
            <input type="password" name="wachtwoord" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Registration form -->
        <form id="register-form" action="verwerk.php" method="post" style="display:none;">
            <input type="hidden" name="actie" value="registratie">
            <input type="text" name="gebruikersnaam" placeholder="Choose a username" required>
            <input type="email" name="email" placeholder="Enter your email address" required>
            <input type="password" name="wachtwoord" placeholder="Choose a password" required>
            <button type="submit">Register</button>
        </form>

        <p id="login-link">No account yet? <a href="#" onclick="toggleForms('register')">Register</a></p>
        <p id="register-link" style="display:none;">Already have an account? <a href="#" onclick="toggleForms('login')">Login</a></p>
    </div>

    <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-image: url("images/login.avif");
      background-size: cover;
      color: white;
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