<?php
session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
include 'dbcon.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin_questions.php");
    exit;
}

// Fetch existing question
$stmt = $db_connection->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->execute([$id]);
$vraag = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vraag) {
    echo "Question not found.";
    exit;
}

// Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'] ?? '';
    $answer = $_POST['answer'] ?? '';
    $hint = $_POST['hint'] ?? '';
    $stmt = $db_connection->prepare("UPDATE questions SET question = ?, answer = ?, hint = ? WHERE id = ?");
    $stmt->execute([$question, $answer, $hint, $id]);
    header("Location: admin_questions.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Question</title>
</head>
<body>
<h2>Edit Question</h2>
<form method="post">
    Question: <input type="text" name="question" value="<?= htmlspecialchars($vraag['question']) ?>" required><br>
    Answer: <input type="text" name="answer" value="<?= htmlspecialchars($vraag['answer']) ?>" required><br>
    Hint: <input type="text" name="hint" value="<?= htmlspecialchars($vraag['hint']) ?>"><br>
    <button type="submit">Save</button>
</form>
<a href="admin_questions.php">Back</a>
</body>
</html>