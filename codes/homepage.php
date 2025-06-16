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

  <h1>Welcome to our escape room!</h1>
  <!-- De button hieronder is alleen voor testdoeleinden bij het opstarten van het project.
     Deze pagina is bedoeld voor de uitleg van jullie escape room. -->

     <section class="intro">
      <p>De aarde staat op het punt om te veranderen in een zwart gat
en jij hebt ervoor gekozen om niet meer in de buurt te zijn als dat gebeurt. <br><br>
Na een paar dagen te hebben gereisd door de ruimte, is een van de motoren uitgevallen. <br><br>
Je hebt geen idee hoe dat kan, maar je hebt geen tijd om erover na te denken. <br><br>
Je moet zo snel mogelijk de motor repareren, anders wordt het ruimteschip meegetrokken in het zwarte gat. <br><br>
Na een paar snelle berekeningen te hebben gemaakt, kom je tot de conclusie dat je nog maar 15 minuten hebt
voordat het ruimteschip wordt vernietigd door het zwarte gat. <br><br>
Je moet de motor repareren en het ruimteschip weer op gang krijgen. <br><br>
Gelukkig heb je een repareer robot bij je die je kan helpen. <br><br>
Maar je moet hem wel de juiste instructies geven. <br><br>
Ook stelt hij veel te veel vragen die je moet beantwoorden. <br><br>
Doe je dat niet dan blijft hij stilstaan en heb je geen kans meer om te ontsnappen. <br><br>
Veel succes!</p>
     </section>

  <button><a href="room 1.php">Click here to start playing!</a></button>

</body>

</html>