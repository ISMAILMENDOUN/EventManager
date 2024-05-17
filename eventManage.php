
<?php

if(isset($_GET['idR'])){

  $con=mysqli_connect("localhost","root","","events");
    $idRegistration=$_GET['idR'];
    //$eU = $_GET['eu'];
   
    mysqli_query($con,"UPDATE user_event SET statut='accepted' WHERE idRegistrtion=$idRegistration");
        
         // header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          //exit();
         
          
          

$to = "ismail.mendoun@gmail.com";
$subject = "Test mail";
$message = "Your subscription to the event has been accepted.";
$headers = "From: sender@example.com";


if (mail($to, $subject, $message, $headers)) {
    echo "Mail sent successfully.";
} else {
    echo "Mail sending failed.";
}


}
      
  

?>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Description</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <section class="eventInforamtions">
    <div class="row mt-5">

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 /* if(isset($_POST['eventImageUp']) && isset($_POST['eventNameUp']) && isset($_POST['eventDescriptionUp']) && isset($_POST['eventDateUp'])){
    $idEvent=$_POST['id'];
    $imageUp = $_POST['eventImageUp'];
    $nameUp = $_POST['eventNameUp'];
    $descriptionUp = $_POST['eventDescriptionUp'];
    $dateUp = $_POST['eventDateUp'];
    $req = "UPDATE event SET image=?, description=?, date=?, name=? WHERE idEvent=$idEvent";
        $stmt = $con->prepare($req);
        $stmt->bind_param("ssss", $imageUp, $descriptionUp, $dateUp, $nameUp);
        if ($stmt->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          
          header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          exit();
      }





  }*/







 /*else*/ 
 
 $redirect=false;
 if(isset($_POST['eventImageUp'])&&$_POST['eventImageUp']!=""){
  $con=mysqli_connect("localhost","root","","events");
    $idEvent=$_POST['id'];
    $imageUp = $_POST['eventImageUp'];
   
    $req = "UPDATE event SET image=? WHERE idEvent=$idEvent";
        $stmt = $con->prepare($req);
        $stmt->bind_param("s", $imageUp);
        if ($stmt->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          
         // header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          //exit();
           $redirect=true;
      }
      mysqli_close($con);
  }
  if(isset($_POST['eventNameUp'])&&$_POST['eventNameUp']!=""){
    $con=mysqli_connect("localhost","root","","events");
    $idEvent=$_POST['id'];
    $nameUp = $_POST['eventNameUp'];
   
    $req = "UPDATE event SET name=? WHERE idEvent=$idEvent";
        $stmt = $con->prepare($req);
        $stmt->bind_param("s", $nameUp);
        if ($stmt->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          
          //header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          //exit();
          $redirect=true;
      }
      mysqli_close($con);
  }


  if(isset($_POST['eventDescriptionUp'])&&$_POST['eventDescriptionUp']!=""){
    $con=mysqli_connect("localhost","root","","events");
    $idEvent=$_POST['id'];
    $descriptionUp = $_POST['eventDescriptionUp'];
   
    $req = "UPDATE event SET description=? WHERE idEvent=$idEvent";
        $stmt = $con->prepare($req);
        $stmt->bind_param("s", $descriptionUp);
        if ($stmt->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          
          //header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          //exit();
          $redirect=true;
      }

      mysqli_close($con);
  }


  if(isset($_POST['eventDateUp'])&&$_POST['eventDateUp']!=""){
    $con=mysqli_connect("localhost","root","","events");
    $idEvent=$_POST['id'];
    $dateUp = $_POST['eventDateUp'];
   
    $req = "UPDATE event SET date=? WHERE idEvent=$idEvent";
        $stmt = $con->prepare($req);
        $stmt->bind_param("s", $dateUp);
        if ($stmt->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          
         // header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");
          //exit();
          $redirect=true;
      }
      mysqli_close($con);
  }

if($redirect==true){

header("Location: ".$_SERVER['PHP_SELF']."?event=$idEvent");

}

























}
$con=mysqli_connect("localhost","root","","events");




if(isset($_GET['delete'])||isset($_GET['update'])){
  
  if(isset($_GET['delete'])){
  $delete=$_GET['delete'];
 
  $quer=mysqli_query($con,"DELETE from event where idEvent=$delete");
  header('Location:manageEvent.php');}
  else{?>


<html>
    <section class="updateEvent">
    <h2>Update Event</h2>
    <form action="eventManage.php" method="POST">
      <div class="form-group">
      <label for="eventName">Image</label>
      <input name="eventImageUp" type="file" class="form-control" id="eventName" placeholder="Enter event name">

        <label for="eventName">Event Name</label>
        <input name="eventNameUp"type="text" class="form-control" id="eventName" placeholder="Enter event name">
      </div>
      <div class="form-group">
        <label for="eventDescription">Event Description</label>
        <textarea name="eventDescriptionUp"class="form-control" id="eventDescription" rows="3" placeholder="Enter event description"></textarea>
      </div>
      <div class="form-group">
        <label for="eventDate">Event Date</label>
        <input name="eventDateUp"type="date" class="form-control" id="eventDate">
      </div>
      <input name="id"type="hidden" value=<?php echo $_GET['update'];?>>
      <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
    </section>
<?php
  


}



}
else{
?>


<body>

  <div class="container">
    <div class="row mt-5">

    <?php


if(isset($_GET['event'])){
$event=$_GET['event'];

$con=mysqli_connect("localhost","root","","events");
$quer=mysqli_query($con,"select * from event");

while($r=mysqli_fetch_array($quer)){
  if($r[0]==$event){
      echo'<div class="col-md-6">
        <img src="images/'.$r[1].'" class="img-fluid" alt="Product Image">
      </div>
      <div class="col-md-6">
        <h2 class="mt-4">'.$r[4].'</h2>
        <p class="text-muted">Category: Category Name</p>
        <p>'.$r[2].'</p>
        <p class="lead">'.$r[3].'</p>

       
        </div> <a href="eventManage.php?delete='.$r[0].'">DELETE</a>
      
        </div> <a href="eventManage.php?update='.$r[0].'">UPDATE</a>';}}
        echo'<a href="manageEvent.php">Go Back</a>';}

        mysqli_close($con);

        ?>
       
        
      </div>
    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
}
?>
</div>
</section>






<section class="eventSubscriptions">
<h1>Event Subscriptions:</h1><br><br>
<?php


if(isset($_GET['event'])){
$event=$_GET['event'];

$con=mysqli_connect("localhost","root","","events");
$quer=mysqli_query($con,"select * from user_event ut,user u where u.idUser=ut.idUser");
echo'<table border=1>';
echo'<table class="table">
<thead><tr>
<th scope="col">Id Registration</th>
<th scope="col">Id User</th>
<th scope="col">First Name</th>
<th scope="col">Last Name</th>
<th scope="col">Email</th>
<th scope="col">Phone</th>
<th scope="col">Date Registration</th>
<th scope="col">Statut</th>
</tr>
</thead>
<tbody>';
while($r=mysqli_fetch_array($quer)){
  if($r['idEvent']==$event){
    
    echo'
    <tr>
      <th scope="row">'.$r['idRegistrtion'].'</th>
      <td>'.$r['idUser'].'</td>
      <td>'.$r['firstName'].'</td>
      <td>'.$r['lastName'].'</td>
      <td>'.$r['email'].'</td>
      <td>'.$r['phone'].'</td>
      <td>'.$r['dateRegistration'].'</td>
      <td>'.$r['statut'].'</td>
      <td><a href="eventManage.php?idR='.$r['idRegistrtion'].'&eU='.$r['email'].'">Accept</a></td>
    </tr>';
        echo '</tr>';
       
        
        }}
        echo' </tbody>
        </table>
        ';
        }

        //mysqli_close($con);

        ?>


    
    
    
 

































</section>
  </div>
</body>
</html>