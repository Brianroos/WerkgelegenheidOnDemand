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
  <div class="page overview">

    <div class="top-navigation">
      <div class="row">
        <div class="columns logo small-12">
          <a href="search.php"><img src="img/logo.png" alt="Werkgelegenheid On Demand"></a>
        </div>
        <div class="columns nav-buttons small-12">
          <a class="close-current" href="search.php"><img src="img/close.png" alt=""></a>
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

    <?php
       echo '<div class="available-work-container hide" data-radius='. $_SESSION['searchedWork'][0]['radius'] .'>';
        foreach($_SESSION['searchedWork'] as $availableWork) {
          echo '<div class="searched-work" data-id="'. $availableWork['id'] .'" data-latitude="'. $availableWork['latitude'] .'" data-longitude="'. $availableWork['longitude'] .'"></div>';
        }
      echo '</div>';
    ?>

    <div id="map-container"></div>
    <div class="map-overlay"></div>

    <?php
      foreach($_SESSION['searchedWork'] as $availableWork) {
        if($availableWork['tag'] == 0) {
          $availableWork['tag'] = 'Alle soorten';
        } else if($availableWork['tag'] == 1) {
          $availableWork['tag'] = 'Kantoor';
        } else if($availableWork['tag'] == 2) {
          $availableWork['tag'] = 'Winkel';
        } else if($availableWork['tag'] == 3) {
          $availableWork['tag'] = 'Club';
        }

        echo '<div class="content company-information company-info-'. $availableWork['id'] .'">
          <div class="row">
            <div class="columns">
              <a class="close close-information" href="#">x</a>
              <h3>'. $availableWork['name'] .'</h3>
              <div class="sections">
                <div class="section c-category">
                  <div class="icon category"></div>
                  <p>'. $availableWork['tag'] .', '. $availableWork['tag_description'] .'</p>
                </div>
                <div class="section c-date">
                  <div class="icon date"></div>
                  <p>'. $availableWork['date'] .'<br><span>'. $availableWork['hours'] .' uur werk</span></p>
                </div>
                <div class="section c-reward">
                  <div class="icon reward"></div>
                  <p>€'. $availableWork['salary'] .' <span>p.u.</span></p>
                </div>
                <div class="section c-location">
                  <div class="icon location"></div>
                  <p>'. $availableWork['street_name'] .'<br>'. $availableWork['zipcode'] .' '. $availableWork['city'] .'</p>
                </div>
              </div>
              <div class="c-submit">
                <a class="btn submit-entry" name="submitEntry" href="applications-overview.php">Aanmelden</a>
              </div>
            </div>
          </div>
        </div>';
      }
    ?>

  </div>
  <script src="js/vendor.min.js"></script>
  <script src="js/script.min.js"></script>
</body>
</html>
