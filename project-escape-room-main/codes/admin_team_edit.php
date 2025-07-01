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

// Fetch team
$stmt = $db_connection->prepare("SELECT * FROM team WHERE id = ?");
$stmt->execute([$id]);
$team = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$team) {
    echo "Team not found.";
    exit;
}

// Delete team including all members
if (isset($_POST['delete_team'])) {
    // First delete all team members
    $stmt = $db_connection->prepare("DELETE FROM teamlid WHERE team_id = ?");
    $stmt->execute([$id]);
    // Then delete the team
    $stmt = $db_connection->prepare("DELETE FROM team WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_teams.php");
    exit;
}

// Delete team member
if (isset($_GET['delete_lid'])) {
    $lid_id = $_GET['delete_lid'];
    $stmt = $db_connection->prepare("DELETE FROM teamlid WHERE id = ?");
    $stmt->execute([$lid_id]);
    header("Location: admin_team_edit.php?id=" . $id);
    exit;
}

// Edit team name
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naam'])) {
    $naam = $_POST['naam'] ?? '';
    $stmt = $db_connection->prepare("UPDATE team SET naam = ? WHERE id = ?");
    $stmt->execute([$naam, $id]);
    header("Location: admin_teams.php");
    exit;
}

// Fetch team members
$leden = [];
$stmt = $db_connection->prepare("SELECT * FROM teamlid WHERE team_id = ?");
$stmt->execute([$id]);
$leden = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Team</title>
</head>
<body>
<h2>Edit Team</h2>
<form method="post">
    Team name: <input type="text" name="naam" value="<?= htmlspecialchars($team['naam']) ?>" required>
    <button type="submit">Save</button>
</form>

<!-- Delete team button -->
<form method="post" onsubmit="return confirm('Are you sure you want to delete this team and all its members?');" style="margin-top:20px;">
    <input type="hidden" name="delete_team" value="1">
    <button type="submit" style="color:red;">Delete this team (including all members)</button>
</form>

<h3>Members of this team</h3>
<ul>
<?php if ($leden): ?>
    <?php foreach ($leden as $lid): ?>
        <li>
            <?= htmlspecialchars($lid['username'] ?? $lid['naam'] ?? 'Unknown') ?>
            <a href="admin_teamlid_edit.php?id=<?= $lid['id'] ?>">Edit</a>
            <a href="admin_team_edit.php?id=<?= $id ?>&delete_lid=<?= $lid['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <li>No members in this team.</li>
<?php endif; ?>
</ul>
<a href="admin_teams.php">Back</a>
</body>
</html>