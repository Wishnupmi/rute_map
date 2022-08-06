<!DOCTYPE html>
<html>
<head>
	<title>Menampilkan Peta dengan LeafletJS</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<style type="text/css">
		#map{
			height:100vh;
		}
	</style>
</head>
<body>
	<div id="map"></div>

	<script type="text/javascript">
       const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};





	function main(pos) {
    //     var lat = (-6.937606785473435);
    // var lng = (109.72429911815212);
    // var lat = position.coords.latitude
    //     var long = position.coords.longitude


    const crd = pos.coords;

//   console.log('Your current position is:');
//   alert(`Latitude : ${crd.latitude}`);
//   console.log(`Longitude: ${crd.longitude}`);
//   console.log(`More or less ${crd.accuracy} meters.`);


  
    var newLatLng = new L.LatLng(crd.latitude, crd.longitude);
    
        var options = {
center: newLatLng,
zoom: 15,
// desiredAccuracy: 30 // defaults to 20
enableHighAccuracy: true,
createMarker: function() { return null; }
}

var map = L.map('map', options);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{attribution: 'WISHNU H'})

.addTo(map);


// var greenIcon = L.icon({
//     iconUrl: 'icons8-user-location-100.png',
//     shadowUrl: 'leaf-shadow.png',

//     iconSize:     [38, 95], // size of the icon
//     shadowSize:   [50, 64], // size of the shadow
//     iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
//     shadowAnchor: [4, 62],  // the same for the shadow
//     popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
// });

var newLatLng1 = new L.LatLng(-6.8804447017835555, 109.75300721418694);
var newLatLng2 = new L.LatLng(crd.latitude, crd.longitude);
var control = L.Routing.control({
waypoints: [
L.latLng(newLatLng1),
L.latLng(newLatLng2)
],
routeWhileDragging: true,
createMarker: function() { return null; },
}).addTo(map);
control.hide();



var greenIcon = L.icon({
    iconUrl: 'help-me-icon-16.jpg',
    // shadowUrl: 'leaf-shadow.png',

    iconSize:     [45, 100]
});

L.marker(newLatLng1, {icon: greenIcon}).addTo(map);



var greenIcon2 = L.icon({
    iconUrl: 'icons8-user-location-100.png',
    // shadowUrl: 'leaf-shadow.png',

    iconSize:     [38, 38]
});

L.marker(newLatLng2, {icon: greenIcon2}).addTo(map);








// /* Initial Map */
// var map = L.map('map').setView(newLatLng,10); //lat, long, zoom

function onLocationFound(e) {
  var puncakmerapi = newLatLng2;

  /* Menghitung jarak antar 2 koordinat dengan satuan km
      Untuk satuan meter tidak perlu dibagi 1000 */
  var distance = (L.latLng(newLatLng1).distanceTo(puncakmerapi) / 1000).toFixed(2);

  var radius = (e.accuracy / 2).toFixed(1);
  
//   var lat = (e.latlng.lat);
//     var lng = (e.latlng.lng);
//     var newLatLng = new L.LatLng(lat, lng);
    // marker.setLatLng(newLatLng); 

  // Membuat marker sesuai koordinat lokasi
  locationMarker = L.marker(newLatLng2, {icon: greenIcon2});
  locationMarker.addTo(map);
  locationMarker.bindPopup("<p class='text-center'>Anda berada <b>" + distance + " km</b><br>dari lokasi penyelamatan<br>Akurasi GPS " + radius + " meter.</p>");
  locationMarker.openPopup();

  // Membuat garis antara koordinat lokasi dengan puncak merapi
//   var latlongline = [newLatLng1,puncakmerapi];
//   var polyline = L.polyline(latlongline, {
//     color: 'red',
//     weight: 5,
//     opacity: 0.7,
//   });
//   polyline.addTo(map);
}

function onLocationError(e) {
  alert(e.message);
}

map.on('locationfound', onLocationFound);
map.on('locationerror', onLocationError);

map.locate({setView: true, maxZoom: 10});







}
window.onload = main;


function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(main, error, options);




	</script>
</body>
</html>