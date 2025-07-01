<?php
session_start();
require_once('dbcon.php');
// Teamnaam instellen via formulier
if (isset($_POST['team_name'])) {
    $_SESSION['team_name'] = trim($_POST['team_name']);
}
$team_name = $_SESSION['team_name'] ?? '';
// Haal teamnamen direct uit team_times
$stmt = $db_connection->query("SELECT * FROM team_times ORDER BY end_time ASC");
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Team Eindtijden</title>
</head>
<body>
    <h1>Team Eindtijden</h1>
    <?php if ($team_name): ?>
        <p><strong>Jouw huidige teamnaam:</strong> <?= htmlspecialchars($team_name) ?></p>
    <?php endif; ?>
    <table border="1">
        <tr>
            <th>Teamnaam</th>
            <th>Starttijd</th>
            <th>Eindtijd</th>
            <th>Duur (minuten)</th>
        </tr>
        <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= htmlspecialchars($team['team_name']) ?></td>
            <td><?= $team['start_time'] ?></td>
            <td><?= $team['end_time'] ?></td>
            <td>
                <?php
                if ($team['end_time']) {
                    $start = strtotime($team['start_time']);
                    $end = strtotime($team['end_time']);
                    echo round(($end - $start) / 60, 2);
                } else {
                    echo '-';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>