<?php
  session_start();
  require 'config.php';

  if(!isset($_SESSION['loggedIn'])) {
    header("location: index.php");
    exit;
  } else if((isset($_GET['action']) && $_GET['action'] === 'logout')) {
    session_destroy();
    header('location: index.php');
    exit;
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
  <div class="page applications-overview">

    <div class="top-navigation">
      <div class="row">
        <div class="columns logo small-12">
          <a href="search.php"><img src="img/logo.png" alt="Werkgelegenheid On Demand"></a>
        </div>
        <div class="columns nav-buttons small-12">
          <a class="open-menu" href="#"><img src="img/menu.png" alt=""></a>
        </div>
      </div>
    </div>
    <div class="main-navigation">
      <a class="close-menu" href="#"><img src="img/close.png" alt=""></a>
      <nav>
        <ul>
          <li><a href="search.php">Nieuwe zoekopdracht</a></li>
          <li><a href="applications-overview.php">Overzicht aanmeldingen</a></li>
          <li><a href="?action=logout">Uitloggen</a></li>
        </ul>
      </nav>
    </div>

    <div class="content applications-information">
      <div class="row">
        <div class="columns">
          <div class="sections">
            <div class="section">
              <div class="a-options">
                <div class="options-wrap">
                  <div class="options-inside">
                    <!-- <a class="delete-application" href="#"><img src="img/delete.png" alt=""></a> -->
                    <!-- <a class="notify-application" href="#"><img src="img/notify.png" alt=""></a> -->
                  </div>
                </div>
              </div>
              <div class="a-information">
                <h4>ZARA</h4>
                <ul>
                  <li>Winkel, kleedkamer medewerker</li>
                  <li>Dinsdag 27 juni, 2 <span>uur werk</span>, 11 <span>p.u.</span></li>
                  <li>Binnenwegplein 31, 3012 KA Rotterdam</li>
                </ul>
              </div>
            </div>
            <div class="section">
              <div class="a-options">
                <div class="options-wrap">
                  <div class="options-inside">
                    <!-- <a class="delete-application" href="#"><img src="img/delete.png" alt=""></a> -->
                  </div>
                </div>
              </div>
              <div class="a-information">
                <h4>Media Markt</h4>
                <ul>
                  <li>Winkel, voorraden vullen</li>
                  <li>Woensdag 28 juni, 2 <span>uur werk</span>, 10 <span>p.u.</span></li>
                  <li>Binnenwegplein 50-52, 3012 KA Rotterdam</li>
                </ul>
              </div>
            </div>
            <div class="section">
              <div class="a-options">
                <div class="options-wrap">
                  <div class="options-inside">
                    <!-- <a class="delete-application" href="#"><img src="img/delete.png" alt=""></a> -->
                  </div>
                </div>
              </div>
              <div class="a-information">
                <h4>NORA</h4>
                <ul>
                  <li>Club, voorraden vullen</li>
                  <li>Donderdag 29 juni, 1 <span>uur werk</span>, 11 <span>p.u.</span></li>
                  <li>Coolsingel 18, 3011 AD Rotterdam</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="js/vendor.min.js"></script>
  <script src="js/script.min.js"></script>
</body>
</html>
