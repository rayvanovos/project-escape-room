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
    <source src="../videos/win.mp4" type="video/mp4">
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

<h1>YOU WIN!!</h1>

<p>congratulations, you've survived and beaten the escape room!</p>

</body>
</html>