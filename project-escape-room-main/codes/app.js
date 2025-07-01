// Dynamisch aantal vragen ophalen
let boxes = document.querySelectorAll('.box');
let correctAnswers = Array(boxes.length).fill(false);

function openModal(index) {
  let box = document.querySelector(`.box[data-index='${index}']`);
  let questionText = box.dataset.question;
  let correctAnswer = box.dataset.answer;

  document.getElementById('question').innerText = questionText;
  document.getElementById('modal').dataset.answer = correctAnswer;
  document.getElementById('modal').dataset.index = index;
  document.getElementById('answer').value = '';
  document.getElementById('feedback').innerText = '';

  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';
}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
  document.getElementById('feedback').innerText = '';
}

function checkAnswer() {
  let userAnswer = document.getElementById('answer').value.trim();
  let correctAnswer = document.getElementById('modal').dataset.answer;
  let feedback = document.getElementById('feedback');
  let index = parseInt(document.getElementById('modal').dataset.index);

  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    feedback.innerText = 'Correct! Goed gedaan!';
    feedback.style.color = 'green';
    correctAnswers[index] = true;

    // Vinkje tonen
    document.getElementById('checkmark-' + index).innerText = '✔️';

    if (correctAnswers.every(Boolean)) {
      setTimeout(function() {
        window.location.href = 'room 2.php';
      }, 1000);
    } else {
      setTimeout(closeModal, 1000);
    }
  } else {
    feedback.innerText = 'Fout, probeer opnieuw!';
    feedback.style.color = 'red';
  }
}

