<!DOCTYPE html>
<html>
<head>
  <title>Carpooling Details</title>
  <style>
    div {
      background-color: #f5f5f5;
      padding: 10px;
      margin-bottom: 10px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
    }
    button:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <?php
  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "KAARpool";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

// Check if the ride has been booked
if (isset($_POST['book'])) {
$id = $_POST['id'];
$sql = "SELECT * FROM carpool WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$available_seats = $row['available_seats'];
if ($available_seats == 0) {
echo "<script>alert('Sorry, this ride has already been booked.');</script>";
} else {
// Book the ride and update the available_seats available
$sql = "UPDATE carpool SET available_seats = available_seats - 1 WHERE id = '$id'";
mysqli_query($conn, $sql);
}
}

// Display the carpooling details
$sql = "SELECT * FROM carpool";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
echo "<div>";
echo "<p><b>Name:</b> " . $row["name"] . "</p>";
echo "<p><b>Source:</b> " . $row["source"] . "</p>";
echo "<p><b>Destination:</b> " . $row["destination"] . "</p>";
echo "<p><b>Date:</b> " . $row["date"] . "</p>";
echo "<p><b>Time:</b> " . $row["time"] . "</p>";
echo "<p><b>available_seats Available:</b> " . $row["available_seats"] . "</p>";
if ($row['available_seats'] > 0) {
echo "<form method='post'>";
echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
echo "<button type='submit' name='book'>Book</button>";
echo "</form>";
} else {
echo "<button disabled>Booked</button>";
}
echo "</div>";
}
} else {
echo "No carpooling details found.";
}

mysqli_close($conn);
?>

</body>
</html>