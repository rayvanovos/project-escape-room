<?php
include 'codes/dbcon.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamnaam = trim($_POST['teamnaam']);
    $leden = array_filter(array_map('trim', $_POST['leden']), fn($v) => $v !== '');

    if ($teamnaam === '' || count($leden) < 1) {
        $error = "Please enter a team name and at least 2 team members.";
    } else {
        // Add team (PDO)
        $stmt = $db_connection->prepare("INSERT INTO team (naam) VALUES (?)");
        if ($stmt->execute([$teamnaam])) {
            $team_id = $db_connection->lastInsertId();
            // Add team members
            $stmt_lid = $db_connection->prepare("INSERT INTO teamlid (team_id, naam) VALUES (?, ?)");
            foreach ($leden as $lid) {
                $stmt_lid->execute([$team_id, $lid]);
            }
                $success = "Team registered successfully!";
                header("Location: codes/homepage.php?success=1");
            exit;
        } else {
            $error = "Error saving the team.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Registration</title>
</head>
<body>
    <h2>Register your team</h2>
    <?php if ($success): ?>
        <p style="color:green;"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Team name: <input type="text" name="teamnaam" required></label><br><br>
        <label>Team members:</label><br>
        <input type="text" name="leden[]" placeholder="Team member 1" required><br>
        <input type="text" name="leden[]" placeholder="Team member 2"><br>
        <input type="text" name="leden[]" placeholder="Team member 3"><br>
        <input type="text" name="leden[]" placeholder="Team member 4"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
</body>
</html>
