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
      <source src="videos/win.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

    <audio id="bg-audio" loop>
  <source src="audio/win.mp3" type="audio/mpeg">
</audio>

  <script>
  window.addEventListener('click', () => {
    const audio = document.getElementById('bg-audio');
    audio.play();
  });
</script>

<h1>YOU WIN!!</h1>

<p>congratulations, you've survived and beaten the escape room!</p>

</body>
</html>