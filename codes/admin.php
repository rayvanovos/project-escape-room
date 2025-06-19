<?php
<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welkom in het Admin Panel!</h1>
    <p>Alleen admins kunnen deze pagina zien.</p>
    <a href="homepage.php">Ga naar homepage</a>
</body>
</html>