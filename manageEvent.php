<?php 
$con=mysqli_connect("localhost","root","","events");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['eventImage'])&&isset($_POST['eventName'])&&isset($_POST['eventDescription'])&&isset($_POST['eventDate'])){
  
$image=$_POST['eventImage'];
$name=$_POST['eventName'];
$description=$_POST['eventDescription'];
$date=$_POST['eventDate'];

if($image!=""&&$name!=""&&$description!=""&&$date!=""){

$req="INSERT INTO  event(image,description,date,name) VALUES(?,?,?,?)";
$stmt=$con->prepare($req);
$stmt->bind_param("ssss",$image,$description,$date,$name);

if($stmt->execute()){

 
 header("Location:manageEvent.php");
  

  }
$stmt->close();

unset($_POST);
}
else{


  echo'<script>alert("Fields are required")</scrpt>';
}
}



}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Events</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5">
    <section cllas="allEvents">
    <h2>All Events</h2>
    <div class="row mt-3">
      <?php 
      
      $query=mysqli_query($con,"select * from event");

while($row=mysqli_fetch_array($query)){
      echo'<div class="col-md-4">
        <a href="eventManage.php?event='.$row[0].'"><div class="card">
          <img class="card-img-top" src="images/'.$row["image"].'" alt="Event 1">
          <div class="card-body">
            <h5 class="card-title">'.$row["name"].'</h5>
            <p class="card-text">'.$row["description"].'</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>';}
      ?>
      
      <!-- Add more event cards here -->
    </div>
    </section>
<section class="addEvent">
    <h2>Add Event</h2>
    <form action="manageEvent.php" method="POST">
      <div class="form-group">
      <label for="eventName">Image</label>
      <input name="eventImage" type="file" class="form-control" id="eventName" placeholder="Enter event name">

        <label for="eventName">Event Name</label>
        <input name="eventName"type="text" class="form-control" id="eventName" placeholder="Enter event name">
      </div>
      <div class="form-group">
        <label for="eventDescription">Event Description</label>
        <textarea name="eventDescription"class="form-control" id="eventDescription" rows="3" placeholder="Enter event description"></textarea>
      </div>
      <div class="form-group">
        <label for="eventDate">Event Date</label>
        <input name="eventDate"type="date" class="form-control" id="eventDate">
      </div>
      <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
    </section>
  </div>

</body>
</html>
