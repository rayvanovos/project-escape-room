<?php
session_start();
require_once('dbcon.php');

try {
  $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 1");
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room 1</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .modal, h2, .modal p {
      color: black;
    }
    .overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      z-index: 10;
      display: none;
    }
    .modal {
      position: fixed;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      padding: 2em;
      z-index: 20;
      display: none;
      border-radius: 10px;
      min-width: 300px;
    }
    .checkmark.checked {
      color: green;
      font-weight: bold;
      font-size: 2em;
      vertical-align: middle;
    }
    .reset-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 0.5em 1em;
      background: red;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<script>
// Zet de duur van de timer in seconden (10 minuten = 600 seconden)
const TOTAL_TIME = 600; 

function startOrContinueTimer() {
  let timerEndTime = localStorage.getItem('escape_timer_end');

  // Start timer als hij nog niet bestaat
  if (!timerEndTime) {
    const now = new Date().getTime();
    timerEndTime = now + TOTAL_TIME * 1000;
    localStorage.setItem('escape_timer_end', timerEndTime);
  }

  // Zet interval om elke seconde te checken
  const interval = setInterval(() => {
    const now = new Date().getTime();
    const remaining = timerEndTime - now;

    if (remaining <= 0) {
      clearInterval(interval);
      localStorage.removeItem('escape_timer_end');
      window.location.href = 'lose.php';
    } else {
      // Toon tijd op scherm (optioneel)
      const minutes = Math.floor(remaining / 60000);
      const seconds = Math.floor((remaining % 60000) / 1000);
      const timerDisplay = document.getElementById('timer');
      if (timerDisplay) {
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
      }
    }
  }, 1000);
}

document.addEventListener('DOMContentLoaded', startOrContinueTimer);
</script>
<div id="timer" style="
  position: fixed;
  top: 10px;
  right: 10px;
  font-size: 1.5em;
  font-weight: bold;
  color: red;
  background-color: white;
  padding: 5px 10px;
  border-radius: 5px;
  z-index: 999;
">
  --
</div>


<div class="container">
  <?php foreach ($questions as $index => $question) : ?>
    <div class="box box<?php echo $index + 1; ?>" onclick="openModal(<?php echo $index; ?>)"
      data-index="<?php echo $index; ?>" 
      data-question="<?php echo htmlspecialchars($question['question']); ?>"
      data-answer="<?php echo htmlspecialchars($question['answer']); ?>">
      Box <?php echo $index + 1; ?>
      <br>
      <span class="checkmark" id="checkmark-<?php echo $index; ?>"></span>
    </div>
  <?php endforeach; ?>
</div>

<section class="overlay" id="overlay" onclick="closeModal()" style="display:none;"></section>

<section class="modal" id="modal" style="display:none;">
  <h2>Escape Room Vraag</h2>
  <p id="question"></p>
  <input type="text" id="answer" placeholder="Typ je antwoord">
  <button onclick="checkAnswer()">Bevestig</button>
  <p id="feedback"></p>
</section>

<script>
window.addEventListener('beforeunload', function () {
  // Verwijder checkmarks en voortgang bij verlaten/herladen
  localStorage.removeItem('answered_questions_room1');
  localStorage.removeItem('room1_completed');
});

const totalQuestions = <?php echo count($questions); ?>;
let answeredQuestions = JSON.parse(localStorage.getItem('answered_questions_room1') || '[]');

function checkAllAnswered() {
  const answeredQuestions = JSON.parse(localStorage.getItem('answered_questions_room1') || '[]');
  console.log(`Beantwoorde vragen: ${answeredQuestions.length} / ${totalQuestions}`);
  console.log('Antwoorden:', answeredQuestions);

  if (answeredQuestions.length === totalQuestions) {
    localStorage.setItem('room1_completed', 'true');
    console.log('Alle vragen beantwoord! Doorsturen naar room2.php...');
    window.location.href = 'room2.php'; // zorg dat dit bestand echt zo heet
  }
}

window.checkAnswer = function() {
  const idx = parseInt(document.getElementById('modal').getAttribute('data-current-index'));
  const userAnswer = document.getElementById('answer').value.trim().toLowerCase();
  const box = document.querySelector('.box[data-index="' + idx + '"]');
  const correctAnswer = box.getAttribute('data-answer').trim().toLowerCase();
  const feedback = document.getElementById('feedback');

  if (userAnswer === correctAnswer) {
    const checkmark = document.getElementById('checkmark-' + idx);
    checkmark.classList.add('checked');
    checkmark.textContent = '✓';

    let answered = JSON.parse(localStorage.getItem('answered_questions_room1') || '[]');
    if (!answered.includes(idx)) {
      answered.push(idx);
      localStorage.setItem('answered_questions_room1', JSON.stringify(answered));
    }

    feedback.textContent = 'Correct!';
    feedback.style.color = 'green';

    setTimeout(() => {
      closeModal();
      checkAllAnswered();
    }, 800);
  } else {
    feedback.textContent = 'Incorrect, probeer opnieuw!';
    feedback.style.color = 'red';
  }
};

window.openModal = function(idx) {
  const box = document.querySelector('.box[data-index="' + idx + '"]');
  if (box) {
    document.getElementById('question').textContent = box.getAttribute('data-question');
    document.getElementById('answer').value = '';
    document.getElementById('feedback').textContent = '';
    document.getElementById('modal').setAttribute('data-current-index', idx);
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('modal').style.display = 'block';
  }
};

window.closeModal = function() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
};

document.addEventListener('DOMContentLoaded', function() {
  let answeredQuestionsShow = JSON.parse(localStorage.getItem('answered_questions_room1') || '[]');
  if (localStorage.getItem('room1_completed') === 'true') {
    answeredQuestionsShow = Array.from({length: totalQuestions}, (_, i) => i);
  }
  answeredQuestionsShow.forEach(function(idx) {
    const el = document.getElementById('checkmark-' + idx);
    if (el) {
      el.classList.add('checked');
      el.textContent = '✓';
    }
  });
});
</script>

</body>
</html>
