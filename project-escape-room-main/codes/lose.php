<?php
session_start();
require_once('dbcon.php');

// Stel teamnaam in via sessie of formulier
$team_name = $_SESSION['team_name'] ?? 'Onbekend';

// Haal starttijd op uit sessie of database
$start_time = $_SESSION['timer_start'] ? date('Y-m-d H:i:s', $_SESSION['timer_start']) : date('Y-m-d H:i:s');

// Sla eindtijd op
$end_time = date('Y-m-d H:i:s');

$stmt = $db_connection->prepare("INSERT INTO team_times (team_name, start_time, end_time) VALUES (?, ?, ?)");
$stmt->execute([$team_name, $start_time, $end_time]);

// ...rest van je win.php code...
?>

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
    <source src="videos/lose.mp4" type="video/mp4">
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

<h1>YOU LOSE!!</h1>

<p>Sorry, you have failed to escape the room. Better luck next time!</p>

<a href="team_times.php" style="display:inline-block;margin-top:2em;padding:1em 2em;background:#007bff;color:#fff;text-decoration:none;border-radius:8px;font-size:1.2em;">Bekijk alle team-eindtijden</a>

</body>
</html>