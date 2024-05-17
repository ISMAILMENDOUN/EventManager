<?php 
/*

if(isset($_POST['firstName'])&&
isset($_POST['lastName'])&&isset($_POST['email'])){
 $firstName=$_POST['firstName'];
 $lastName=$_POST['lastName'];
 $email=$_POST['email'];
$con=mysqli_connect("localhost","root","","events");
$req=mysqli_query($con,"SELECT idUser FROM user WHERE firstName=? AND lastName=? AND email=?");
$stmt = prepare($req);
$stmt->bind_param("sss",$firstName,$lastName,$email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $idUser);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

var_dump($idUser);




}
*/

?>
<?php
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $con = mysqli_connect("localhost", "root", "", "events");

    $req = mysqli_prepare($con, "SELECT idUser FROM user WHERE firstName=? AND lastName=? AND email=?");

    if ($req) {
        mysqli_stmt_bind_param($req, "sss", $firstName, $lastName, $email);
        mysqli_stmt_execute($req);
        mysqli_stmt_bind_result($req, $idUser);
        mysqli_stmt_fetch($req);
        mysqli_stmt_close($req);

        session_start();
        $_SESSION['firstName']=$firstName;
        $_SESSION['lastName']=$lastName;
        $_SESSION['email']=$email;
        $_SESSION['user']=$idUser;
        header('Location:user.php?');
        //var_dump($idUser);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
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
    <div class="row mt-5">
<form action="userSign.php" method="POST">
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
      
      <br>
      <input name ="eventId"type="hidden" value="<?php// echo$_GET['event'];?>">
      <button type="submit" class="btn btn-primary">Check My Events</button>
    </form>
        <a href="index.php">Go Back</a>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>