<?php
    session_start();
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-voting</title>
    </head>
    <body style="background-color:#165769;color:white;">
        <?php
        include'nav.php';
        ?>
        <div class="row">
            <div class="col-sm-12" style="padding-left:20px;">
                <h2>View Register Voters</h2>
                <hr><br>
                <?php
                $link = mysqli_connect("localhost", "root","", "votingdb");
                $qry = "select * from voter";
                $resultset = mysqli_query($link, $qry);
                if (mysqli_num_rows($resultset) > 0)
                {
                    echo "<div class='table-reponsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>Voter Id</th><th>Name</th><th>Password</th><th>Aadhar No</th><th>Gender</th><th>Type</th>";
                    echo "</tr>";
                    while($r= mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td>$r[2]</td>";
                        echo "<td>$r[3]</td>";
                        echo "<td>$r[4]</td>";
                        echo "<td>$r[5]</td>";
                        echo "<td><a class='btn btn-danger' href='deletevoter.php?id=$r[0]'>Delete Record</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } 
                else 
                {
                    echo "<h3 style='color:white; text-align:center'>No Record Found";
                }
                mysqli_close($link);
                ?>
            </div>
        </div>

    </body>
</html>
