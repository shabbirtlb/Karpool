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
    <label for="waypoints">Waypoints:</label>
    <input type="text" name="waypoints">
    <br>
    <button type="submit">Generate Map</button>
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = urlencode($_POST["origin"]);
    $destination = urlencode($_POST["destination"]);
    $waypoints = isset($_POST["waypoints"]) ? "&waypoints=" . urlencode($_POST["waypoints"]) : "";
    $src = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=$origin&destination=$destination$waypoints";
    $iframe = "<iframe width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" src=\"$src\" allowfullscreen></iframe>";
    echo $iframe;
  }
  ?>
</body>
</html>







