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
          <li><a href="#">Nieuwe zoekopdracht</a></li>
          <li><a href="#">Overzicht aanmeldingen</a></li>
          <li><a href="#">Uitloggen</a></li>
        </ul>
      </nav>
    </div>

    <div id="map-container"></div>

    <div class="form search-form">
      <div class="row">
        <div class="columns">
          <form action="#" method="post">
            <div class="form-row">
              <label for="prefJob">Soort werk</label>
              <select name="prefJob">
                <option value="0">Alle soorten</option>
                <option value="1">Soort werk 1</option>
                <option value="2">Soort werk 2</option>
              </select>
            </div>
            <div class="form-row">
              <label for="prefHours">Aantal uur</label>
              <input type="number" name="prefHours" placeholder="2" min="1" max="8">
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
