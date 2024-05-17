<?php $con=mysqli_connect("localhost","root","","events");

$hide=0;

?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-light bg-light justify-content-center">
    <a href="userSign.php">MyEvents<a>
    <form class="form-inline " action="index.php" method="GET">
   <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search Event" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<div class="container">
<section class="searchResults">

<?php 
if(isset($_GET['search'])){
$input=$_GET['search'];
echo'<h2>Search Results: </h2>
<div class="row mt-3">';
$hide=1;



      
      $query=mysqli_query($con,"select * from event");
      $empty=true;
while($row=mysqli_fetch_array($query)){
  if($row[4]===$input){
      echo'<div class="col-md-4">
        <a href="event.php?event='.$row[0].'"><div class="card">
          <img class="card-img-top" src="images/'.$row["image"].'" alt="Event 1">
          <div class="card-body">
            <h5 class="card-title">'.$row["name"].'</h5>
            <p class="card-text">'.$row["description"].'</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>';
      $empty=false;}}
      if($empty==true){

        echo'<h2>0 result</h2>';
        echo'<h3>  <a href="user.php">Go Back</a></h3>';
      }}
      
      ?>
      
<!--<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/logo.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="event.php" class="btn btn-primary">Check Event</a>
  </div>-->



</section>

<section class="event">
<h2>All Events</h2>
    <div class="row mt-3">
<?php 
      
      $query=mysqli_query($con,"select * from event");

while($row=mysqli_fetch_array($query)){
      echo'<div class="col-md-4">
        <a href="event.php?event='.$row[0].'"><div class="card">
          <img class="card-img-top" src="images/'.$row["image"].'" alt="Event 1">
          <div class="card-body">
            <h5 class="card-title">'.$row["name"].'</h5>
            <p class="card-text">'.$row["description"].'</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>';}
      ?>
      </div>
<!--<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/logo.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="event.php" class="btn btn-primary">Check Event</a>
  </div>-->
</div>


</section>



</div>



<footer></footer>
</body>

<?php 


if($hide==1){
  echo'<script>document.querySelector(".event").style.display="none";</script>';
}
?>