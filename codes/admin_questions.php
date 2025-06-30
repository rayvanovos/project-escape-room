<?php
session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
include 'dbcon.php';

// Delete via POST (safer)
if (isset($_POST['delete'])) {
    $stmt = $db_connection->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$_POST['delete']]);
    header("Location: admin_questions.php");
    exit;
}

// Fetch questions
$vragen = $db_connection->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Questions</title>
</head>
<body>
    <a href="admin.php">Back</a>
    <br>
    <br>
<h2>Questions</h2>
<a href="admin_question_add.php">Add new question</a>
<table border="1">
<tr><th>ID</th><th>Question</th><th>Answer</th><th>Hint</th><th>Action</th></tr>
<?php foreach ($vragen as $vraag): ?>
<tr>
  <td><?= $vraag['id'] ?></td>
  <td><?= htmlspecialchars($vraag['question']) ?></td>
  <td><?= htmlspecialchars($vraag['answer']) ?></td>
  <td><?= htmlspecialchars($vraag['hint']) ?></td>
  <td>
    <a href="admin_question_edit.php?id=<?= $vraag['id'] ?>">Edit</a> |
    <form method="post" action="admin_questions.php" style="display:inline;" onsubmit="return confirm('Are you sure?')">
      <input type="hidden" name="delete" value="<?= $vraag['id'] ?>">
      <button type="submit">Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>