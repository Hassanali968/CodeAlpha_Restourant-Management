<?php

include("connection.php");

$id=$_GET['id'];

$q="DELETE FROM `orders` where id=$id";

$result= mysqli_query($con,$q);

if($result){

    header("location: show.php");
}

?>