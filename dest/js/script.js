function init() {
  // Init Foundation
  $(document).foundation();

  var mapContainer = $('#map-container');
  if(mapContainer.length) {
    initMaps();
  }
}
init();

// FUNC: Init map and set props
function initMaps() {
  var accessToken = ''; // Add token for working version
  var currentLocation = [51.917422, 4.484835];
  var map = L.map('map-container').setView(currentLocation, 14);
  var radius = 1000;
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

  // Check for page to show more map details
  if(page.hasClass('overview')) {
    var radiusCircle = L.circle(L.latLng(currentLocation), radius, {
      className: 'radius-circle',
      color: '#2FC3B6',
      fillColor: '#85DAD2',
      fillOpacity: 0.5,
      weight: 2
    }).addTo(map);

    companyLocations.push([51.918362, 4.480185]);
    companyLocations.push([51.918027, 4.477735]);

    $.each(companyLocations, function(key, value) {
      var companyLocation = new L.latLng(value[0], value[1]);
      var companyMarker = L.icon({
        className: 'company-marker company-'+ key,
        iconUrl: 'img/company-marker.png',
        iconSize: [31, 40],
        iconAnchor: [15, 40]
      });

      if(new L.latLng(currentLocation).distanceTo(companyLocation) < radius) {
        L.marker([value[0], value[1]], {icon: companyMarker}).on('click', clickOnMarker).addTo(map);
      }
    });
  }
}

// FUNC: Handler when a (company)marker is clicked
function clickOnMarker(e) {
  var mapOverlay = $('.map-overlay');
  var companyPopup = $('.content.company-information');

  mapOverlay.addClass('show');
  companyPopup.addClass('show');

  $(document).on('click', '.map-overlay, .close.close-information', function(e) {
    mapOverlay.removeClass('show');
    companyPopup.removeClass('show');
  });
}
