
<?php 


function insertForUser(){
  session_start();
  $con=mysqli_connect("localhost","root","","events");
  $em=$_SESSION['email'];
  $rst=mysqli_query($con,"SELECT idUser from user where email='$em'");
  $idUser=mysqli_fetch_array($rst)[0];
  var_dump($idUser);
  $dateRegistration=date('Y-m-d H:i:s');
  $event1=$_GET['eventUser'];
  
      $req1 = "INSERT INTO user_event(idUser,idEvent,dateRegistration) values(?,?,?)";
      $stmt1 = $con->prepare($req1);
      $stmt1->bind_param("iis",$idUser,$event1,$dateRegistration);
      if ($stmt1->execute()) {
        echo '<script>alert("Added successfully")</script>';
      
        $stmt1->close();
      header('Location:user.php?user='.$idUser);
    
    
    }}


function insert($firstName,$lastName,$email,$tel){

  

  if(isset($firstName)&&isset($lastName)&&isset($email)&&isset($tel)){

    $con=mysqli_connect("localhost","root","","events");
    /*$firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];*/
    if(mysqli_fetch_array(mysqli_query($con,"select max(idUser) from user"))[0]){
    $idUser=mysqli_fetch_array(mysqli_query($con,"select max(idUser) from user"))[0]+1;}
    else{
  
      $idUser=1;
    }
    //var_dump($idUser);
    $dateRegistration=date('Y-m-d H:i:s');
    $event1=$_POST['eventId'];
    $req = "INSERT INTO user(firstName,lastName,email,phone) values(?,?,?,?)";
        $stmt = $con->prepare($req);
        $stmt->bind_param("ssss",$firstName,$lastName,$email,$tel);
  
        $req1 = "INSERT INTO user_event(idUser,idEvent,dateRegistration) values(?,?,?)";
        $stmt1 = $con->prepare($req1);
        $stmt1->bind_param("iis",$idUser,$event1,$dateRegistration);
        if ($stmt->execute()&&$stmt1->execute()) {
          echo '<script>alert("Added successfully")</script>';
          $stmt->close();
          $stmt1->close();
          return $event1;
  }
  }
  
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){

$_GET['event']=insert($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['tel']);
}

if(isset($_GET['eventUser'])){
  
  insertForUser();





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

  <div class="container pb-5">
    <div class="row mt-5">

    <?php

$event=$_GET['event'];
$con=mysqli_connect("localhost","root","","events");
$quer=mysqli_query($con,"select * from event");

while($r=mysqli_fetch_array($quer)){
  if($r[0]==$event){
    $dt=new dateTime($r[3]);
   $dt=$dt->format('Y-m-d').' At '.$dt->format('H:i');
      echo'<div class="col-md-6">
        <img width="450" height="450"src="images/'.$r[1].'" class="img-fluid" alt="Product Image">
      </div>
      <div class="col-md-6">
        <h2 class="mt-4">'.$r[4].'</h2>
        <p class="text-muted">Category: Category Name</p>
        <p>'.$r[2].'</p>
        
        <p class="lead">Date :'.$dt.'</p>
        </div>';}}
        session_start();
        if(!isset($_SESSION['firstName'])&&!isset($_SESSION['lastName'])&&!isset($_SESSION['email'])){
        ?>
      <h2 class="mt-3">Subscribtion Form:</h2>
        <form action="event.php" method="POST">
      <div class="form-group">
        <label for="fullName">First Name</label>
        <input name="firstName" type="text" class="form-control" id="firstName" placeholder="Enter your first name">
      </div>
      <div class="form-group">
        <label for="fullName">Last Name</label>
        <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Enter your last name">
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
        
      </div>
      <div class="form-group">
        <label for="phoneNumber">Phone Number</label>
        <input name="tel"type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phone number">
      </div>
      <br>
      <input name ="eventId"type="hidden" value="<?php echo$_GET['event'];?>">
      <button type="submit" class="btn btn-dark">Register</button>
    </form>
        

    <?php }else{$event=$_GET['event'];echo'<a href="event.php?eventUser='.$event.'">Register</a>';} ?>
        <a href="index.php">Go Back</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
