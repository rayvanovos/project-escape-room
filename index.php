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
      <source src="videos/homepage.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

      <audio id="bg-audio" loop>
  <source src="audio/homepage.mp3" type="audio/mpeg">
</audio>

<script>
  window.addEventListener('click', () => {
    const video = document.getElementById('bg-video');
    const audio = document.getElementById('bg-audio');

    // Set volumes BEFORE playing
    video.muted = false;
    video.volume = 0.2; // Set video volume to 20%
    audio.volume = 0.1; // Set audio volume to 10%

    // Now play the audio
    audio.play();
  }, { once: true }); // Only run this on the first click
</script>



  <h1 class="welcome">Welcome to our escape room!</h1>
  <!-- De button hieronder is alleen voor testdoeleinden bij het opstarten van het project.
     Deze pagina is bedoeld voor de uitleg van jullie escape room. -->
     <p class="story">De aarde staat op het punt om te veranderen in een zwart gat 
      <br> en jij hebt ervoor gekozen om niet meer in de buurt te zijn als dat gebeurt.
      <br> Na een paar dagen te hebben gereisd door de ruimte, is een van de motoren uitgevallen.
      <br> Je hebt geen idee hoe dat kan, maar je hebt geen tijd om erover na te denken.
      <br> Je moet zo snel mogelijk de motor repareren, anders wordt het ruimteschip meegetrokken in het zwarte gat.
      <br> Na een paar snelle berekeningen te hebben gemaakt, kom je tot de conclusie dat je nog maar 15 minuten hebt 
      <br> voordat het ruimteschip wordt vernietigd door het zwarte gat.
      <br> Je moet de motor repareren en het ruimteschip weer op gang krijgen.
      <br> Gelukkig heb je een repareer robot bij je die je kan helpen.
      <br> Maar je moet hem wel de juiste instructies geven.
      <br> Ook stelt hij veel te veel vragen die je moet beantwoorden.
      <br> Doe je dat niet dan blijft hij stilstaan en heb je geen kans meer om te ontsnappen.
      <br> Veel succes!</p>
    </p>

  <button><a href="room 1.php">click here to start</a></button>

</body>

</html>