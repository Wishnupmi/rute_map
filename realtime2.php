<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime location tracker</title>

    <!-- leaflet css  -->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />

    <style>
        @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700');
* {
  margin:0;
}
* + * {
  margin-top:10px;
}
body {
  background-color:#eee;
  margin:0;
}
body,button,input {
  font-family:'IBM Plex Sans',sans-serif;
  font-size:1 rem;
  line-height:0.5;
}
button,input {
  background-color:#eee;
  border:1px #999 solid;
  border-radius:4px;
  cursor:pointer;
  padding:5px 15px;
  transition:all 250ms;
}
form {
  padding:40px;
}
label {
  display:block;
}
#map {
    width: 100%;
            height: 80vh;
}
    </style>
</head>

<body>
   














   


<div id="map"></div>

<br><br>
<form>
<label for="latitude">Latitude:</label>
<input id="latitude" type="text" /><br>
<label for="longitude">Longitude:</label>
<input id="longitude" type="text" /><br>
:: or, enter your own lat-long values and <input type="button" value="Jump there" onClick="updateLatLng(document.getElementById('latitude').value,document.getElementById('longitude').value,1)">
:: <a href="#" onclick="map.zoomOut(3, {animate:true})">zoom out</a> ::
:: <a href="#" onclick="map.zoomIn(3, {animate:true})">zoom in</a>
</form>
<br><br>


<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script> <!-- Orginal: http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js -->
<script>

var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
});




if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        // setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition)
        // }, 5000);
    }

function getPosition(position){
        // console.log(position)
        var lat = position.coords.latitude
        var long = position.coords.longitude
        var accuracy = position.coords.accuracy

//remember last position
var rememberLat = document.getElementById('latitude').value;
var rememberLong = document.getElementById('longitude').value;

if( !rememberLat || !rememberLong ) { rememberLat = lat; rememberLong = long;}



var map = new L.Map('map', {
'center': [rememberLat, rememberLong],
'zoom': 18,
'layers': [tileLayer]
});

var marker = L.marker([rememberLat, rememberLong],{
draggable: true
}).addTo(map);
marker.on('dragend', function (e) {
updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
});
map.on('click', function (e) {
marker.setLatLng(e.latlng);
updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
});
function updateLatLng(lat,lng,reverse) {
if(reverse) {
marker.setLatLng([lat,lng]);
map.panTo([lat,lng]);
} else {
document.getElementById('latitude').value = marker.getLatLng().lat;
document.getElementById('longitude').value = marker.getLatLng().lng;
map.panTo([lat,lng]);
}
}

        // alert("Your coordinate is: Lat: "+ lat +" Long: "+ long+ " Accuracy: "+ accuracy)

        
    }



//remember last position
// var rememberLat = document.getElementById('latitude').value;
// var rememberLong = document.getElementById('longitude').value;

// if( !rememberLat || !rememberLong ) { rememberLat = 18.53; rememberLong = 73.85;}



</script>


