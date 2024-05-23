<?php
    $vid = $_GET['id'];
    $link=mysqli_connect("localhost","root","","votingdb");
    $qry = "delete from category where cid=$vid";
    mysqli_query($link,$qry);
    mysqli_close($link);
    header("location:categorylist.php");
?>

