<!DOCTYPE html>
<html>
<head>
  <title>Google Maps iFrame Generator</title>
</head>
<body>
  <form method="post">
    <label for="origin">Origin:</label>
    <input type="text" name="origin" required>
    <br>
    <label for="destination">Destination:</label>
    <input type="text" name="destination" required>
    <br>
    <button type="submit">Generate Map</button>
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = urlencode($_POST["origin"]);
    $destination = urlencode($_POST["destination"]);
    $src = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=$origin&destination=$destination";
    $iframe = "<iframe width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" src=\"$src\" allowfullscreen></iframe>";
    echo $iframe;
  }




  ?>
  <!DOCTYPE html>
<html>
<head>
  <title>Google Maps iFrame Generator</title>
  <script src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=$origin&destination=$destination";>
</script>
  <script>
    var map;
    var originMarker;
    var destinationMarker;
    var stopMarker;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: { lat: 37.7749, lng: -122.4194 },
      });

      originMarker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        draggable: true,
        title: "Origin",
      });

      destinationMarker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        draggable: true,
        title: "Destination",
      });

      google.maps.event.addListener(originMarker, "dragend", function () {
        updateIframe();
      });

      google.maps.event.addListener(destinationMarker, "dragend", function () {
        updateIframe();
      });
    }

    function updateIframe() {
      var origin = originMarker.getPosition().lat() + "," + originMarker.getPosition().lng();
      var destination = destinationMarker.getPosition().lat() + "," + destinationMarker.getPosition().lng();
      var stop = "";
      if (stopMarker) {
        stop = stopMarker.getPosition().lat() + "," + stopMarker.getPosition().lng();
      }
      var src = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=" + origin + "&destination=" + destination;
      if (stop) {
        src += "&waypoints=" + stop;
      }
      var iframe = document.getElementById("map-iframe");
      iframe.setAttribute("src", src);
    }

    function addStop() {
      stopMarker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        draggable: true,
        title: "Stop",
      });

      google.maps.event.addListener(stopMarker, "dragend", function () {
        updateIframe();
      });
      updateIframe();
    }
  </script>
</head>
<body onload="initMap()">
  <div id="map" style="height: 500px; width: 100%;"></div>
  <button onclick="addStop()">Add Stop</button>
  <br>
  <iframe id="map-iframe" width="600" height="450" frameborder="0" style="border:0" src="" allowfullscreen></iframe>
</body>
</html>

</body>
</html>
