<!DOCTYPE html>
<html>
<head>
  <title>Insert Data Into Database</title>
</head>
<body>
  <h2>Insert Data Into Database</h2>
  <form method="post">
    <label for="id">ID:</label>
    <input type="text" name="id" required>
    <br>
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <br>
    <label for="origin">origin:</label>
    <input type="text" name="origin" required>
    <br>
    <label for="destination">Destination:</label>
    <input type="text" name="destination" required>
    <br>
    <label for="date">Date:</label>
    <input type="date" name="date" required>
    <br>
    <label for="time">Time:</label>
    <input type="time" name="time" required>
    <br>
    <label for="waypoints">Waypoints:</label>
    <input type="text" name="waypoints">
    <br>
    <label for="available_seats">available_seats Available:</label>
    <input type="number" name="available_seats" min="1" max="3" required>
    <br>
    <button type="submit" name="submit">Submit</button>
  </form>

  <?php
  if (isset($_POST['submit'])) {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "KAARpool";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into the database
    $id = $_POST["id"];
    $name = $_POST["name"];
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $available_seats = $_POST["available_seats"];

    $sql = "INSERT INTO carpool (id, name, origin, destination, date, time, available_seats) VALUES ('$id', '$name', '$origin', '$destination', '$date', '$time', '$available_seats')";

    if (mysqli_query($conn, $sql)) {
      echo "Data inserted successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  }
  ?>
</body>
</html>
