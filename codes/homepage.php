<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<div id="timer" style="font-size:2em; color:red; display:none;">15:00</div>
<script>
  // Reset timer bij binnenkomst op de homepage
  localStorage.setItem('timer_running', 'false');
  localStorage.setItem('timer_remaining', '900');
  // Toon timer alleen als hij in localStorage staat (dus als hij loopt)
  if (localStorage.getItem('timer_running') === 'true') {
    document.getElementById('timer').style.display = 'block';
    updateTimer();
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
    }
  }
</script>

<section class="video-background">
  <video id="bg-video" loop>
    <source src="../videos/homepage.mov" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</section>


<script>
  window.addEventListener('click', () => {
    const video = document.getElementById('bg-video');

    video.muted = false;      // Unmute
    video.volume = 0.2;       // Set volume to 20%
    video.play();             // Play the video

  }, { once: true }); // Only run this on the first click
</script>

  <h1>Welcome to our escape room!</h1>
  <!-- The button below is only for testing purposes when starting the project.
     This page is intended for the explanation of your escape room. -->

     <section class="intro">
      <p>The earth is about to turn into a black hole
and you have chosen not to be around when that happens. <br><br>
After traveling through space for a few days, one of the engines has failed. <br><br>
You have no idea how that happened, but you don't have time to think about it. <br><br>
You must repair the engine as quickly as possible, otherwise the spaceship will be pulled into the black hole. <br><br>
After making some quick calculations, you conclude that you only have 15 minutes left
before the spaceship is destroyed by the black hole. <br><br>
You need to repair the engine and get the spaceship moving again. <br><br>
Luckily, you have a repair robot with you that can help. <br><br>
But you have to give it the right instructions. <br><br>
It also asks way too many questions that you have to answer. <br><br>
If you don't, it will stop and you will have no chance to escape. <br><br>
Good luck!</p>
     </section>

  <button><a href="room 1.php">Click here to start playing!</a></button>

</body>

</html>