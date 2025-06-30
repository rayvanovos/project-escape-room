<?php
session_start();
require_once('dbcon.php');



try {
  $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 1");
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Database error: " . $e->getMessage());
}



if (!isset($_SESSION['timer_start'])) {
    $_SESSION['timer_start'] = time();
    $_SESSION['timer_duration'] = 900; // 15 minuten in seconden
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room 1</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Voeg dit toe in de body van room 1.php -->
<div id="timer" style="font-size:2em; color:red;">15:00</div>
<script>
  // Start timer in localStorage alleen als hij nog niet loopt
  if (localStorage.getItem('timer_running') !== 'true') {
    localStorage.setItem('timer_running', 'true');
    localStorage.setItem('timer_remaining', '900');
  }

  // Houd bij welke vragen zijn beantwoord in localStorage
  const totalQuestions = <?php echo count($questions); ?>;
  let answeredQuestions = JSON.parse(localStorage.getItem('answered_questions_room1') || '[]');

  // Zet checkmarks bij geladen pagina
  answeredQuestions.forEach(function(idx) {
    const el = document.getElementById('checkmark-' + idx);
    if (el) el.classList.add('checked');
  });

  function updateTimer() {
    let remaining = parseInt(localStorage.getItem('timer_remaining') || 900);
    if (remaining > 0) {
      let min = Math.floor(remaining / 60);
      let sec = remaining % 60;
      document.getElementById('timer').textContent = `${min}:${sec.toString().padStart(2, '0')}`;
      setTimeout(() => {
        localStorage.setItem('timer_remaining', remaining - 1);
        updateTimer();
      }, 1000);
    } else {
      localStorage.setItem('timer_running', 'false');
      window.location.href = 'lose.php';
    }
  }
  updateTimer();

// ...existing code...
function checkAllAnswered() {
  let answered = 0;
  for (let i = 0; i < totalQuestions; i++) {
    if (document.getElementById('checkmark-' + i).classList.contains('checked')) {
      answered++;
    }
  }
  if (answered === totalQuestions) {
    // Timer NIET stoppen, alleen voortgang opslaan
    // answered_questions_room1 NIET resetten!
    window.location.href = 'room 2.php';
  }
}
// ...existing code...

  // Patch de bestaande checkAnswer functie zodat hij checkAllAnswered aanroept
  const origCheckAnswer = window.checkAnswer;
  window.checkAnswer = function() {
    const idx = parseInt(document.getElementById('modal').getAttribute('data-current-index'));
    origCheckAnswer();
    // Voeg toe aan answeredQuestions als nog niet aanwezig
    setTimeout(function() {
      const el = document.getElementById('checkmark-' + idx);
      if (el && el.classList.contains('checked') && !answeredQuestions.includes(idx)) {
        answeredQuestions.push(idx);
        localStorage.setItem('answered_questions_room1', JSON.stringify(answeredQuestions));
      }
      checkAllAnswered();
    }, 100);
  };

  // Zorg dat openModal het index attribuut op de modal zet
  window.openModal = function(idx) {
    // ...bestaande openModal code...
    document.getElementById('modal').setAttribute('data-current-index', idx);
    // ...bestaande openModal code...
  };
</script>

<div class="container">
  <?php foreach ($questions as $index => $question) : ?>
    <div class="box box<?php echo $index + 1; ?>"
         onclick="openModal(<?php echo $index; ?>)"
         data-index="<?php echo $index; ?>"
         data-question="<?php echo htmlspecialchars($question['question']); ?>"
         data-answer="<?php echo htmlspecialchars($question['answer']); ?>">
      Question <?php echo $index + 1; ?>
       <br>
      <span class="checkmark" id="checkmark-<?php echo $index; ?>"></span>
    </div>
  <?php endforeach; ?>
</div>

<section class="overlay" id="overlay" onclick="closeModal()"></section>

<section class="modal" id="modal">
  <h2>Escape Room Question</h2>
  <p id="question"></p>
  <input type="text" id="answer" placeholder="Type your answer">
  <button onclick="checkAnswer()">Submit</button>
  <p id="feedback"></p>
</section>

<style>
  .modal,h2{
    color: black;
  }
  .modal,p{
    color: black;
  }
</style>

<script src="app.js"></script>

<a class="test" href="win.php">test win</a>
<br><br><br>
<a class="test" href="lose.php">test lose</a>

</body>
</html>