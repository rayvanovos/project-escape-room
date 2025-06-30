<?php
$host = 'localhost';
$db =  'escape-room';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$actie = $_POST['actie'] ?? '';
$gebruikersnaam = $_POST['gebruikersnaam'] ?? '';
$email = $_POST['email'] ?? '';
$wachtwoord = $_POST['wachtwoord'] ?? '';

if ($actie === 'registratie') {
    // Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: index.php?msg=Username already exists.");
        exit;
    }

    // Hash password and save user
    $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $gebruikersnaam, $hash, $email);
    if ($stmt->execute()) {
        header("Location: index.php?msg=Registration successful, you can now log in.");
    } else {
        header("Location: index.php?msg=Registration failed.");
    }
    exit;
}

if ($actie === 'login') {
    // Allow login with username or email
    $stmt = $conn->prepare("SELECT gebruikersnaam, wachtwoord, email, Rol FROM gebruikers WHERE gebruikersnaam = ? OR email = ?");
    $stmt->bind_param("ss", $gebruikersnaam, $gebruikersnaam);
    $stmt->execute();
    $stmt->bind_result($db_gebruikersnaam, $hash, $db_email, $rol);
    if ($stmt->fetch()) {
        $stmt->close();
        if (password_verify($wachtwoord, $hash)) {
            session_start();
            $_SESSION['gebruikersnaam'] = $db_gebruikersnaam;
            $_SESSION['email'] = $db_email;
            $_SESSION['Rol'] = $rol;
            if ($rol === 'admin') {
                header("Location: codes/admin.php");
            } else {
                header("Location: team_register.php?msg=Successfully logged in!");
                exit;
            }
            
        } else {
            header("Location: index.php?msg=Invalid login credentials.");
            exit;
        }
    } else {
        header("Location: index.php?msg=Invalid login credentials.");
        exit;
    }
}

$conn->close();
?>