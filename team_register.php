<?php
include /codes/dbcon.php; // Zorg ervoor dat je de juiste databaseverbinding hebt

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamnaam = trim($_POST['teamnaam']);
    $leden = array_map('trim', $_POST['leden']);

    if ($teamnaam === '' || empty($leden) || in_array('', $leden)) {
        $error = "Vul een teamnaam en alle teamleden in.";
    } else {
        // Voeg team toe
        $stmt = $conn->prepare("INSERT INTO team (naam) VALUES (?)");
        $stmt->bind_param("s", $teamnaam);
        if ($stmt->execute()) {
            $team_id = $conn->insert_id;
            // Voeg teamleden toe
            $stmt_lid = $conn->prepare("INSERT INTO teamlid (team_id, naam) VALUES (?, ?)");
            foreach ($leden as $lid) {
                $stmt_lid->bind_param("is", $team_id, $lid);
                $stmt_lid->execute();
            }
            $success = "Team succesvol geregistreerd!";
        } else {
            $error = "Fout bij het opslaan van het team.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Team Registratie</title>
</head>
<body>
    <h2>Registreer je team</h2>
    <?php if ($success): ?>
        <p style="color:green;"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Teamnaam: <input type="text" name="teamnaam" required></label><br><br>
        <label>Teamleden:</label><br>
        <input type="text" name="leden[]" placeholder="Teamlid 1" required><br>
        <input type="text" name="leden[]" placeholder="Teamlid 2" required><br>
        <input type="text" name="leden[]" placeholder="Teamlid 3"><br>
        <input type="text" name="leden[]" placeholder="Teamlid 4"><br>
        <button type="submit">Registreer</button>
    </form>
</body>
</html>
