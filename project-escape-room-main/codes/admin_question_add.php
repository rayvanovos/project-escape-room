<?php
session_start();
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: homepage.php");
    exit;
}
include 'dbcon.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');
    $hint = trim($_POST['hint'] ?? '');

    if ($question === '' || $answer === '') {
        $error = "Question and answer are required.";
    } else {
        $stmt = $db_connection->prepare("INSERT INTO questions (question, answer, hint) VALUES (?, ?, ?)");
        $stmt->execute([$question, $answer, $hint]);
        header("Location: admin_questions.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Question</title>
</head>
<body>
    <a href="admin_questions.php">Back to questions</a>
    <h2>Add New Question</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Question:<br>
            <input type="text" name="question" required>
        </label><br><br>
        <label>Answer:<br>
            <input type="text" name="answer" required>
        </label><br><br>
        <label>Hint:<br>
            <input type="text" name="hint">
        </label><br><br>
        <button type="submit">Add Question</button>
    </form>
</body>