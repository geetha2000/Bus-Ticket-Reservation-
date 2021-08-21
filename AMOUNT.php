<?php
require "dbconfig/config.php";
$busid='';
$fare='';
$amount='';
$gstamount='';
?>
<!DOCTYPE html>
<html>
<head>
<title> Home Page</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
       <center> <h1><b>A.G BUS LINES</b></h1>
        <h6> "Smiles of miles on your way"</h6></center>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">A G BUS LINES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item ">
                <a class="nav-link" href="home.php">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="aboutus.php">ABOUT US</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contactus.php">CONTACT US</a>
                </li>
                <li class="nav-item ">
                <a class="nav-link" href="busmodify.php">ADD BUS DETAILS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="viewbus.php">VIEW BUS DETAILS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="userdetails.php">VIEW USER DETAILS</a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="AMOUNT.php">VIEW BOOKING DETAILS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="admin.php">LOG OUT</a>
                </li>
             </ul>
          </div>
        </nav>
        <br>


<body style ="background:linear-gradient(rgb(255,223,0,1),rgba(0, 181, 204,0.8) );">
<style>
     .tab {
 margin-left: 16.3em
}
.tab1{
    margin-left:1em
}
.tab2{
    margin-left: 14.6em
}
.tab3{
    margin-left: 12em
}
.tab4{
    margin-left: 11em
}
h2{
    background-color:yellow;
}

</style>
<body>
    <center>
        <center>
    <h1>Amount Details</h1>
    </center>
        <div class="container4">
        <form action="AMOUNT.php" method="POST">
            <label><b>BUSID:</label></br>
            <input type="integer" name="busid" placeholder="enter busid"required/></br></br>
            <input type="submit" name="search" value="SEARCH"/>
        </form>
        </div>
    <?php
if(isset($_POST['search']))
{
    $busid=$_POST['busid'];
    echo "<br> BUSID : $busid </br>";
}
$sql="SELECT SUM(no_of_seats) AS seats FROM reservation WHERE busid='$busid' AND bookstatus='booked';";
$result=mysqli_query($con , $sql);
while ($row = $result->fetch_assoc()) {
    echo "<br>NO OF BOOKED SEATS : ";
    echo $row['seats']."</br>";
    $seats=$row['seats'];
}
$sqli="SELECT busfare FROM busdetails WHERE busid='$busid';";
$res=mysqli_query($con , $sqli);
while ($row = $res->fetch_assoc()) {
        $fare = $row['busfare'];
        echo "<br>BUSFARE : $fare</br>";
}
if (is_numeric($seats) && is_numeric($fare)) {
    $amount=$seats*$fare;
    $gstamount=$amount*1.05;
  }
 else {
    // "do some error handling...";
  }
echo "<br>TOTAL AMOUNT : $amount </br>";
echo "<br>TOTAL AMOUNT WITH GST : $gstamount </br>";

?>
    <br>
    <br>
    <br>
    <br>
    <h1> Passengers Details</h1>
    </center>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">PID</th>
      <th scope="col">PNRNO</th>
      <th scope="col">USERID</th>
      <th scope="col">NAME</th>
      <th scope="col">GENDER</th>
      <th scope="col">AGE</th>
    </tr>
  </thead>
 <?php
        if(isset($_POST['search']))
        {
            $busid=$_POST['busid'];
        }
        $sql ="SELECT * FROM passengers WHERE pnrno IN (SELECT pnrno FROM reservation WHERE busid='$busid' AND bookstatus='booked');";
        $retval = $con->query($sql) or die($con->error);
        if($retval->num_rows >0)
  {
        while ($row = $retval->fetch_assoc()) {
          echo"<tr>
            <td>".$row["pid"]."</td>
            <td>".$row["pnrno"]."</td>
            <td>".$row["userid"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["gender"]."</td>
            <td>".$row["age"]."</td>
            </tr>
            ";
        }
        echo "</table>";
    }
    else
    {   if($retval->num_rows <0)
        echo "no rows";
    }
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</table>
</body>
</html>





