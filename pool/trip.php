<?php
session_start();
include ('conn.php'); 
$id=$_POST['id'];
$_SESSION['trip']=$id;
$q="SELECT * from `trips` where `Id` like $id";
$e=mysqli_query($conn,$q);
$q1="SELECT * from `$id`";
$ex=mysqli_query($conn,$q1);
$d0=mysqli_fetch_assoc($e);
?>
<html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
  <style>
    body{
      overflow:hidden;
    }
    </style>
<body>
<div class="topnav" id="myTopnav" style="top:4px;font-family:'Times New Roman';background-color: maroon;color:azure;height: 50px;left:25%;position:absolute; width:46%;vertical-align: middle !important;border-radius:30px">
        <div class="rt-container">    
        <form action="lout.php">
                  <button type="submit" style="position:absolute;right:20px;background:transparent;color: aliceblue;border:none;">Logout</button>
                </form>     
                <a href="profile.php">
                  <button type="submit" style="position:absolute;right:100px;background:transparent;color: aliceblue;border:none;">Profile</button> </a>
        <div class="col-rt-2">
            <ul>
            <a href ="home.php" style="text-decoration:none;color:aliceblue;">Back to Home</button></a>
            </ul>
        </div>
</div>
        </div>
        <?php
        echo "<div class='map'>";
 
 $origin = $d0['Startpoint'];
 $destination = $d0['Endpoint'];
 $waypoints=$d0['waypoint'];
 if($waypoints !=""){
  $src = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=$origin&destination=$destination&waypoints=$waypoints";
 }
 else{
     $src = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDZDNstAoeoNej3xtlCKZwT-Jl5IlK3wBE&origin=$origin&destination=$destination";
 }
echo "<iframe position='absolute' width='75%' height='100%' frameborder=0 src='$src' allowfullscreen></iframe>";
echo "</div>";
?>
  <div class="card" style="position:absolute;top:55px;left:810px;color:whitesmoke;width:420px;border:1px solid black;background:rgb(0,0,0,0.8)">
    <div class="card-header" style="border-bottom:1px solid black;">
    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Trip Details</h3>
          <h3 class="mb-0">Vehicle :<?php echo $d0["Vehicle"] ?> </h5>
          <h3 class="mb-0">Numplate :<?php echo $d0["Numplate"] ?> </h5>
          <h3 class="mb-0">Startpoint :<?php echo $d0["Startpoint"] ?> </h5>
          <h3 class="mb-0">Endpoint :<?php echo $d0["Endpoint"] ?> </h5>
          <?php if($d0['waypoint'] != ""){
            ?>
          <h3 class="mb-0">Waypoint :<?php echo $d0["waypoint"] ?> </h5>
           <?php } ?>
</div>
<div class="card-body pt-0" style="height:170px">      
<table class="table table-striped table-bordered" style="width:400px;color:whitesmoke">
  <thead>   
    <tr>
      <th scope="col">User</th>
      <th scope="col">Type</th>
      <th scope="col">Startpoint</th>
      <th scope="col">Endpoint</th>
      <th scope="col-span-2">Mobile</th>
      <th scope="col-span-2">Gender</th>
    </tr>
  </thead>
  <tbody>
  <?php
        while($d1=mysqli_fetch_assoc($ex)){
    ?>
    <tr>
      <?php $u=$_SESSION['user'];
      $us=$d1['User'];
      if($u==$us){
        ?>
      <th scope="row">You</th>
      <?php } 
      else {?>
          <th scope="col-span-2"><?php echo $us?></th>
      <?php }?>
      <td><?php echo $d1['Type'] ?></td>
      <td><?php echo $d1['Startpoint'] ?></td>
      <td><?php echo $d1['Endpoint'] ?></td>
      <td><?php echo $d1['Mobile'] ?></td>
      <td><?php echo $d1['Gender'] ?></td>
    </tr>
    <?php 
      }
    ?>

            </tbody>
            </table>
          </div>
        </div>
        </div>
        <br>
        <div class="box" style="position:absolute;top:0px;left:1277px;background-color:#ffff;width:450px;height:100%;border:1px solid black;background:rgb(0,0,0,0.5);color:whitemoke">
        <!DOCTYPE html>
<html>
<head>
	<title>Simple Chatting System</title>
</head>
<body>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pool";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// if (isset($_POST['submit'])) {
    $id = $_SESSION['trip'];

    // Create a separate .txt file for each id in the database
    $filename = 'chat-' . $id . '.txt';
    if (!file_exists($filename)) {
        $file = fopen($filename, 'w');
        fclose($file);
    }
    ?>
    <h2 style="color:whitesmoke;">Welcome, <?php echo $_SESSION['user']; ?></h2>
    <h2 style="color:whitesmoke;">Chat :</h2>
    <?php 
        // Display the chat history
        $filename = 'chat-' . $id . '.txt';
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            while (!feof($file)) {
                ?><p style="color:whitesmoke"><?php echo fgets($file) .'</p>';
            }
            fclose($file);
        } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="message" style="color:whitesmoke;">Enter your message:</label>
        <input type="text" name="message" id="message">
        <input type="submit" name="submit" value="Send">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $message = $_POST['message'];

        // Append the message to the corresponding .txt file
        $filename = 'chat-' . $id . '.txt';
        $file = fopen($filename, 'a');
        fwrite($file, $_SESSION['user'] . ': ' . $message . "\n");
        fclose($file);
    }
    ?>
        <?php
?>
    </div>
</body>   