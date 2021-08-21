<?php
require "dbconfig/config.php";
include "header.php";
$busid='';
if(isset($_GET['t']))
{
  $busid=$_GET['t'];
}

    $query5="DELETE FROM busdetails WHERE busid='$busid'";
    if($con->query($query5)===TRUE)
    {
            echo '<script type ="text/javascript"> alert("Bus details deleted successfuly ....") </script>';
            header('location:viewbus.php');
    }
   else
   {
    echo '<script type ="text/javascript"> alert("Bus details  not deleted successfuly ....") </script>';
   }
?>