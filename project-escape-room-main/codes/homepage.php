<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>






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

<button onclick="startGame()">Start Escape Room</button>

<script>
function startGame() {
  // Verwijder oude timer
  localStorage.removeItem('escape_timer_end');
  // Start opnieuw (optioneel, kan ook door gewoon naar room1 te gaan)
  window.location.href = 'room1.php';
}
</script>

</body>

</html>