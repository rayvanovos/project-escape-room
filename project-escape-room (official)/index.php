<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Login & Registratie</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2 id="form-title">Registratie</h2>
    <form action="verwerk.php" method="post">
      <input type="hidden" name="actie" id="actie" value="registratie">
      <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
      <button type="submit">Verzenden</button>
      <p id="toggle-form">
        Heb je al een account? <a href="#" onclick="wisselForm()">Login</a>
      </p>
    </form>
    <p id="bericht">
      <?php if (isset($_GET['msg'])) echo htmlspecialchars($_GET['msg']); ?>
    </p>
  </div>

  <script>
    let login = false;
    function wisselForm() {
      login = !login;
      document.getElementById("form-title").textContent = login ? "Login" : "Registratie";
      document.getElementById("actie").value = login ? "login" : "registratie";
      document.getElementById("toggle-form").innerHTML = login
        ? 'Nog geen account? <a href="#" onclick="wisselForm()">Registreer</a>'
        : 'Heb je al een account? <a href="#" onclick="wisselForm()">Login</a>';
    }
  </script>

  <style>
    body {
  font-family: Arial, sans-serif;
  text-align: center;
  background-image: url("images/login.avif");
  background-size: cover;
}

#toggle-form,a{
  color: white;
}
  </style>
  
</body>
</html>