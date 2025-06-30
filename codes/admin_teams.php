<?php
session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
include 'dbcon.php';

// Delete
if (isset($_GET['delete'])) {
    $stmt = $db_connection->prepare("DELETE FROM team WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: admin_teams.php");
    exit;
}

// Fetch teams
$teams = $db_connection->query("SELECT * FROM team")->fetchAll(PDO::FETCH_ASSOC);

// Fetch team members per team
$teamleden = [];
$stmt = $db_connection->query("SELECT * FROM teamlid");
while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $team_id = $user['team_id'] ?? null;
    if ($team_id) {
        $teamleden[$team_id][] = $user;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Manage Teams</title></head>
<body>
<a href="admin.php">Back</a>
<br>
<br>
<h2>Teams</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Members</th><th>Action</th></tr>
<?php foreach ($teams as $team): ?>
<tr>
  <td><?= $team['id'] ?></td>
  <td><?= htmlspecialchars($team['naam']) ?></td>
  <td>
    <?php if (!empty($teamleden[$team['id']])): ?>
      <ul>
        <?php foreach ($teamleden[$team['id']] as $lid): ?>
          <li><?= htmlspecialchars($lid['naam'] ?? 'Unknown') ?></li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      No members
    <?php endif; ?>
  </td>
  <td>
    <a href="admin_team_edit.php?id=<?= $team['id'] ?>">Edit</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>