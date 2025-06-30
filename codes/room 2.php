<?php
session_start();
require_once('dbcon.php');

try {
  $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 2");
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Database error: " . $e->getMessage());
}

// Fallback: PHP timer check (voor als JS uit staat)
if (isset($_SESSION['timer_start']) && isset($_SESSION['timer_duration'])) {
    $elapsed = time() - $_SESSION['timer_start'];
    if ($elapsed > $_SESSION['timer_duration']) {
        header("Location: lose.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room 2</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<div id="timer" style="font-size:2em; color:red;">15:00</div>
<script>
  // Alleen timer tonen als hij loopt
  if (localStorage.getItem('room2_completed') === 'true') {
  document.getElementById('timer').textContent = "00:00";
  localStorage.setItem('timer_running', 'false');
} else {
  // Start timer als hij niet loopt
  if (localStorage.getItem('timer_running') !== 'true') {
    localStorage.setItem('timer_running', 'true');
    localStorage.setItem('timer_remaining', '900');
  }
  updateTimer();
}

  const totalQuestions = <?php echo count($questions); ?>;
  let answeredQuestions = JSON.parse(localStorage.getItem('answered_questions_room2') || '[]');

  if (localStorage.getItem('room2_completed') === 'true') {
    answeredQuestions = Array.from({length: totalQuestions}, (_, i) => i);
    localStorage.setItem('answered_questions_room2', JSON.stringify(answeredQuestions));
    localStorage.setItem('timer_running', 'false');
  }

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

  function checkAllAnswered() {
    let answered = 0;
    for (let i = 0; i < totalQuestions; i++) {
      if (document.getElementById('checkmark-' + i).classList.contains('checked')) {
        answered++;
      }
    }
    if (answered === totalQuestions) {
      localStorage.setItem('timer_running', 'false');
      localStorage.setItem('room2_completed', 'true');
      window.location.href = 'win.php';
    }
  }

  // Zorg dat origCheckAnswer bestaat, anders fallback naar lege functie
  const origCheckAnswer = window.checkAnswer || function(){};
  window.checkAnswer = function() {
    const idx = parseInt(document.getElementById('modal').getAttribute('data-current-index'));
    origCheckAnswer();
    setTimeout(function() {
      const el = document.getElementById('checkmark-' + idx);
      if (el && el.classList.contains('checked') && !answeredQuestions.includes(idx)) {
        answeredQuestions.push(idx);
        localStorage.setItem('answered_questions_room2', JSON.stringify(answeredQuestions));
      }
      checkAllAnswered();
    }, 100);
  };

  window.openModal = function(idx) {
    // Vul de modal met de juiste vraag en antwoord
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
</script>

<div class="container">
  <?php foreach ($questions as $index => $question) : ?>
    <div class="box box<?php echo $index + 2; ?>" onclick="openModal(<?php echo $index; ?>)"
      data-index="<?php echo $index; ?>" data-question="<?php echo htmlspecialchars($question['question']); ?>"
      data-answer="<?php echo htmlspecialchars($question['answer']); ?>">
      Box <?php echo $index + 2; ?>
      <br>
      <span class="checkmark" id="checkmark-<?php echo $index; ?>"></span>
    </div>
  <?php endforeach; ?>
</div>

<script>
  // Zet checkmarks bij geladen pagina (nu bestaat de HTML)
  let answeredQuestionsShow = JSON.parse(localStorage.getItem('answered_questions_room2') || '[]');
  if (localStorage.getItem('room2_completed') === 'true') {
    answeredQuestionsShow = Array.from({length: <?php echo count($questions); ?>}, (_, i) => i);
  }
  answeredQuestionsShow.forEach(function(idx) {
    const el = document.getElementById('checkmark-' + idx);
    if (el) el.classList.add('checked');
  });
</script>

<section class="overlay" id="overlay" onclick="closeModal()" style="display:none;"></section>

<section class="modal" id="modal" style="display:none;">
  <h2>Escape Room Question</h2>
  <p id="question"></p>
  <input type="text" id="answer" placeholder="Type your answer">
  <button onclick="checkAnswer()">Submit</button>
  <p id="feedback"></p>
</section>

<style>
  .modal, h2 {
    color: black;
  }
  .modal, p {
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
  }
</style>

<!-- Optioneel: test links -->
<a class="test" href="win.php">test win</a>
<br><br><br>
<a class="test" href="lose.php">test lose</a>

</body>
</html>