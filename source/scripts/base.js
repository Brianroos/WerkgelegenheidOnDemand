function init() {
  // Init Foundation
  $(document).foundation();

  toggleMenu();

  var mapContainer = $('#map-container');
  if(mapContainer.length) {
    initMaps();
  }
}
init();

// FUNC: Toggle to show/hide menu
function toggleMenu() {
  var mainNavigation = $('.main-navigation');
  var showButton = $('.open-menu');
  var hideButton = $('.close-menu');

  showButton.on('click', function(e) {
    e.preventDefault();
    mainNavigation.addClass('show');
  });
  hideButton.on('click', function(e) {
    e.preventDefault();
    mainNavigation.removeClass('show');
  });
}

// FUNC: Init map and set props
function initMaps() {
  var accessToken = ''; // Add token for working version
  var currentLocation = [51.917422, 4.484835]; // Demo purpose
  // if('geolocation' in navigator) {
  //   navigator.geolocation.getCurrentPosition(function(position) {
  //     var currentLocation = [position.coords.latitude, position.coords.longitude];
  //   });
  // }
  var map = L.map('map-container').setView(currentLocation, 14);
  var radius = $('.available-work-container').data('radius');
  var companyLocations = [];
  var page = $('.page');

  L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=' + accessToken, {
    minZoom: 14,
    maxZoom: 16
  }).addTo(map);

  var studentMarker = L.icon({
    className: 'student-marker',
    iconUrl: 'img/student-marker.png',
    iconSize: [60, 39],
    iconAnchor: [29, 32]
  });
  L.marker(currentLocation, {icon: studentMarker}).addTo(map);

  // Check for (overview) page to show more map details
  if(page.hasClass('overview')) {
    var radiusCircle = L.circle(L.latLng(currentLocation), radius, {
      className: 'radius-circle',
      color: '#2FC3B6',
      fillColor: '#85DAD2',
      fillOpacity: 0.5,
      weight: 2
    }).addTo(map);

    // Push every filtered/searched company to array
    $('.searched-work').each(function() {
      var id = $(this).data('id');
      var latitude = $(this).data('latitude');
      var longitude = $(this).data('longitude');

      companyLocations.push([id, latitude, longitude]);
    });

    $.each(companyLocations, function(key, value) {
      var companyLocation = new L.latLng(value[1], value[2]);
      var companyMarker = L.icon({
        className: 'company-marker company-marker-'+ value[0],
        iconUrl: 'img/company-marker.png',
        iconSize: [31, 40],
        iconAnchor: [15, 40]
      });

      if(new L.latLng(currentLocation).distanceTo(companyLocation) <= radius) {
        L.marker([value[1], value[2]], {icon: companyMarker}).on('click', clickOnMarker).addTo(map);
      }
    });
  }
}

// FUNC: Handler when a (company)marker is clicked
function clickOnMarker(e) {
  var thisMarkerId = this._icon.classList[2];
  thisMarkerId = thisMarkerId.split('-')[2];

  var mapOverlay = $('.map-overlay');
  var companyPopup = $('.content.company-information');

  $.each(companyPopup, function(key, value) {
    var thisCompany = value;
    value = value.classList[2].split('-')[2];

    if(thisMarkerId == value) {
      mapOverlay.addClass('show');
      $(thisCompany).addClass('show');

      return false;
    }
  });

  $(document).on('click', '.map-overlay, .close.close-information', function(e) {
    mapOverlay.removeClass('show');
    companyPopup.removeClass('show');
  });
}
