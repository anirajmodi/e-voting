<?php
    $vid = $_GET['id'];
    $link=mysqli_connect("localhost","root","","votingdb");
    $qry = "delete from election where pid=$vid";
    mysqli_query($link,$qry);
    mysqli_close($link);
    header("location:votinglist.php");
?>