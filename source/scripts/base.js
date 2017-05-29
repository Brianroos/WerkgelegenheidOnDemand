function init() {
  // Init Foundation
  $(document).foundation();

  initMaps();
}
init();

// FUNC: Init map and set props
function initMaps() {
  var accessToken = ''; // Add token for working version
  var currentLocation = [52.010592, 4.544100];
  var map = L.map('map-container').setView(currentLocation, 15);
  var radius = 600;
  var companyLocations = [];

  L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=' + accessToken, {
    minZoom: 14,
    maxZoom: 16
  }).addTo(map);

  var radiusCircle = L.circle(L.latLng(currentLocation), radius, {
    className: 'radius-circle',
    color: '#2FC3B6',
    fillColor: '#85DAD2',
    fillOpacity: 0.5,
    weight: 2
  }).addTo(map);

  var studentMarker = L.icon({
    className: 'student-marker',
    iconUrl: 'img/student-marker.png',
    iconSize: [60, 39],
    iconAnchor: [29, 34]
  });
  var companyMarker = L.icon({
    className: 'company-marker',
    iconUrl: 'img/company-marker.png',
    iconSize: [31, 40],
    iconAnchor: [15, 40]
  });

  L.marker(currentLocation, {icon: studentMarker}).addTo(map);
  companyLocations.push([52.010299, 4.530509]);
  companyLocations.push([52.009754, 4.537472]);

  $.each(companyLocations, function(key, value) {
    var companyLocation = new L.latLng(value[0], value[1]);

    if(new L.latLng(currentLocation).distanceTo(companyLocation) < radius) {
      L.marker([value[0], value[1]], {icon: companyMarker}).addTo(map);
    }
  });
}
