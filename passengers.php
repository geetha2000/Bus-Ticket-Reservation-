<?php
require 'dbconfig/config.php';
session_start();
$busid = $_SESSION['busid'];
$userid = $_SESSION['userid'];
$rows='';
$no_of_seats=null;
$sql = "SELECT availableseats FROM busdetails WHERE busid = '$busid'";
$retval = mysqli_query($con , $sql);
while ($row2 = $retval->fetch_assoc())
{
    $availableseats = $row2['availableseats'] ;
}
$_SESSION['availableseats'] = $availableseats;
?>
<!DOCTYPE html>
<html>
<head>
<title> Home Page</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body style ="background:linear-gradient(rgb(255,223,0,1),rgba(0, 181, 204,0.8) );">
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
                <li class="nav-item active">
                <a class="nav-link" href="booktickets.php">BOOK TICKET</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="userlogin.php">LOG OUT</a>
                </li>
             </ul>
          </div>
        </nav>
        <br>
</head>
<center>
<div class="container4">
<form method="get" >
    <label><b>TOTAL PASSENGERS:</label></br>
    <input type="number" value=<?=$rows?> max="10" min="1" name="no_of_seats" required></br>
    &#160;&#160;&#160;&#160;
    <input type="submit" id="pas_btn" name="submit2"></br>
</form>
<form method="post">
    <?php
    if(isset($_GET['no_of_seats']))
    {
            $rows = $_GET['no_of_seats'];
            $no_of_seats = $rows;
    }
    $_SESSION['no_of_seats']=$no_of_seats;
    echo "<br><br>No_Of_Seats:$no_of_seats</center>";
    ?>
    </form>
    <br>
</div>
<?php
if($no_of_seats <= $availableseats)
{

    $query1="INSERT INTO reservation( busid , userid , no_of_seats , bookstatus ) VALUES('$busid','$userid','$no_of_seats','booked');";
                $query_run1 = mysqli_query($con , $query1);
                $pnrno = mysqli_insert_id($con);
                echo "<br><center>Pnr No: $pnrno</center>";
                $_SESSION['pnrno']=$pnrno;
}
    else
    {
        echo "seats are not available";
        echo "log out and try again next time";
        exit;
    }
?>
<br>
</center>
<center>
<a href="booking.php">PROCEED</a>
</center>
</body>
</html>




