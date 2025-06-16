<?php
$host = 'localhost';
$db =  'escape-room';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

$actie = $_POST['actie'] ?? '';
$gebruikersnaam = $_POST['gebruikersnaam'] ?? '';
$email = $_POST['email'] ?? '';
$wachtwoord = $_POST['wachtwoord'] ?? '';

if ($actie === 'registratie') {
    // Check of gebruiker al bestaat
    $stmt = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: index.php?msg=Gebruikersnaam bestaat al.");
        exit;
    }

    // Wachtwoord hashen en gebruiker opslaan
    $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $gebruikersnaam, $hash, $email);
    $stmt->execute();

    header("Location: index.php?msg=Registratie geslaagd, je kunt nu inloggen.");
    exit;
}

if ($actie === 'login') {
    $stmt = $conn->prepare("SELECT wachtwoord FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $stmt->bind_result($hash);
    if ($stmt->fetch() && password_verify($wachtwoord, $hash)) {
        header("Location: codes/homepage.php?msg=Succesvol ingelogd!");
    } else {
        header("Location: index.php?msg=Ongeldige inloggegevens.");
    }
    exit;
}

$conn->close();
?>