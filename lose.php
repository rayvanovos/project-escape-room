<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="video-background">
    <video id="bg-video" autoplay muted loop>
      <source src="videos/lose.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

      <audio id="bg-audio" loop>
  <source src="audio/lose.mp3" type="audio/mpeg">
</audio>

  <script>
  window.addEventListener('click', () => {
    const audio = document.getElementById('bg-audio');
    audio.play();
  });
</script>

<h1>YOU LOSE!!</h1>

<p>Sorry, you have failed to escape the room. Better luck next time!</p>

</body>
</html>