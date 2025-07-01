<?php


session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Admin Panel!</h1>
    <p>Only admins can see this page.</p>
    <button onclick="homepage()">To homepage for players</button>
    <button onclick="teams()">To the teams page</button>
    <button onclick="questions()">To the questions page</button>

    <script>
      function homepage() {
        window.location.href = 'homepage.php';
      }
      function teams() {
        window.location.href = 'admin_teams.php';
      }
      function questions() {
        window.location.href = 'admin_questions.php';
      }
    </script>
</body>
</html>
</html>
