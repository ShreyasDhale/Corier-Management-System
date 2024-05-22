<?php 
    include("../includes/Connection.php");
    $track=$_POST['track'];
    $st=$conn->prepare("delete from parcel_info where trackid=$track");
    $st->execute();
    $msg="delete";
    include("../includes/success.php");
?>