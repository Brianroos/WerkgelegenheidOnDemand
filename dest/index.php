<?php
  session_start();
  require 'config.php';
?>
<?php
  if(isset($_POST['submit'])) {
    $email = mysql_real_escape_string($_POST['email']);
    $pass = mysql_real_escape_string($_POST['password']);

    $query = 'SELECT * FROM werkgelegenheidStudents WHERE email = "'. $email .'" AND password = "'. $pass .'"';
    $result = mysql_query($query, $conn);

    if($query) {
      if($row = mysql_fetch_assoc($result)) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $row;

        if($_SESSION['loggedIn'] && $_SESSION['loggedIn'] == true) {
          header('location: search.php');
          exit;
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Werkgelegenheid On Demand</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge; chrome=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="stylesheet" type="text/css" href="css/style.min.css">
</head>
<body>
  <div class="page index">

    <div class="intro">
      <div class="row">
        <div class="columns">
          <img src="img/logo-big.png" alt="Werkgelegenheid On Demand">

          <div class="form login-form">
            <form action="index.php" method="post">
              <div class="form-row">
                <label for="email">E-mail</label>
                <input type="email" name="email" required>
              </div>
              <div class="form-row">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" required>
              </div>
              <div class="form-row submit-row">
                <input type="submit" name="submit" value="Inloggen">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="js/vendor.min.js"></script>
  <script src="js/script.min.js"></script>
</body>
</html>
