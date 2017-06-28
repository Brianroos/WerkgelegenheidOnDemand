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
<?php
  if(isset($_POST['submit'])) {
    $_SESSION['searchedWork'] = ''; // Clear searched work current session

    $prefJob = mysql_real_escape_string($_POST['prefJob']);
    $prefHours = mysql_real_escape_string($_POST['prefHours']);
    $prefRadius = mysql_real_escape_string($_POST['prefRadius']);

    if($prefJob == 0) {
      $query = 'SELECT * FROM werkgelegenheidWork
        INNER JOIN werkgelegenheidCompanies ON werkgelegenheidWork.companyId = werkgelegenheidCompanies.id
        WHERE hours <= "'. $prefHours .'"';
    } else {
      $query = 'SELECT * FROM werkgelegenheidWork
        INNER JOIN werkgelegenheidCompanies ON werkgelegenheidWork.companyId = werkgelegenheidCompanies.id
        WHERE tag = "'. $prefJob .'" AND hours <= "'. $prefHours .'"';
    }
    $result = mysql_query($query, $conn);

    if(mysql_num_rows($result) > 0) {
      while($row = mysql_fetch_assoc($result)) {
        $row['radius'] = $prefRadius;
        $_SESSION['searchedWork'][] = $row;
      }

      header('location: overview.php');
      exit;
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
  <div class="page search">

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

    <div id="map-container"></div>

    <div class="form search-form">
      <div class="row">
        <div class="columns">
          <form action="search.php" method="post">
            <div class="form-row">
              <label for="prefJob">Soort werk</label>
              <select name="prefJob">
                <option value="0">Alle soorten</option>
                <option value="1">Kantoor</option>
                <option value="2">Winkel</option>
                <option value="3">Club</option>
              </select>
            </div>
            <div class="form-row">
              <label for="prefHours">Beschikbare aantal uur</label>
              <input type="number" name="prefHours" placeholder="2" min="1" max="8" required>
            </div>
            <div class="form-row range-row">
              <label for="prefRadius">Straal <span>(in meters)</span></label>
              <input type="range" name="prefRadius" min="400" max="1000" step="100" value="600" oninput="this.form.prefRadiusInput.value=this.value">
              <input type="number" name="prefRadiusInput" min="400" max="1000" step="100" value="600" oninput="this.form.prefRadius.value=this.value">
            </div>
            <div class="form-row submit-row">
              <input type="submit" name="submit" value="Zoeken">
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  <script src="js/vendor.min.js"></script>
  <script src="js/script.min.js"></script>
</body>
</html>
