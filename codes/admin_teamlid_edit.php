<?php
session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
include 'dbcon.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin_teams.php");
    exit;
}

// Fetch team member
$stmt = $db_connection->prepare("SELECT * FROM teamlid WHERE id = ?");
$stmt->execute([$id]);
$lid = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lid) {
    echo "Team member not found.";
    exit;
}

// Edit team member
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'] ?? '';
    $stmt = $db_connection->prepare("UPDATE teamlid SET naam = ? WHERE id = ?");
    $stmt->execute([$naam, $id]);
    header("Location: admin_team_edit.php?id=" . $lid['team_id']);
    exit;
}

// Delete team member
if (isset($_GET['delete'])) {
    $stmt = $db_connection->prepare("DELETE FROM teamlid WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_team_edit.php?id=" . $lid['team_id']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Team Member</title>
</head>
<body>
<h2>Edit Team Member</h2>
<form method="post">
    Name: <input type="text" name="naam" value="<?= htmlspecialchars($lid['naam'] ?? '') ?>"><br>
    <button type="submit">Save</button>
</form>
<br>
<a href="admin_team_edit.php?id=<?= $lid['team_id'] ?>">Back to team</a>
</body>
</html>