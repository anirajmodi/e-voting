<?php
    session_start();
    $msg = "";
    if(isset($_POST['btnsave']))
    {
        $title = $_POST['title'];
        $link = mysqli_connect("localhost","root","","votingdb");
        $qry = "insert into election(title) values('$title')";
        mysqli_query($link,$qry);
        if(mysqli_affected_rows($link)>0)
            $msg = "Title added Successfully !!!!!!";
        else
            $msg = "Error Title not added..........";
        mysqli_close($link);
    }
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
            <div class="col-sm-6" style="padding-left:20px;">
                <h2>Voting Form</h2>
                <hr>
                <form method="POST">
                    <div>
                        <div class="col-sm-3" style="text-align:right;">
                            <label>Title</label>
                        </div>
                        <div class="col-sm-9">
                            <input required style="width:100%;color:black;border-radius:5px;"type="text" name="title" value=""><br><br>
                        </div>
                    </div>
                    
                    <div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input style="background-color:red;border-radius:5px;" type="submit" name="btnsave" value="Save">
                        </div>
                    </div>
                    <div style="text-align:center;color:greenyellow;">
                        <?php
                            echo "$msg";
                        ?>
                    </div>
                </form>
                
                
            </div>
            <div class="col-sm-6"style="padding-right:20px;" >
                <h2>View Candidates</h2>
                <hr>
                <?php
                $link = mysqli_connect("localhost", "root","", "votingdb");
                $qry = "select * from election";
                $resultset = mysqli_query($link, $qry);
                if (mysqli_num_rows($resultset) > 0)
                {
                    echo "<div class='table-reponsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>S.No.</th><th>Title</th>";
                    echo "</tr>";
                    while($r= mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td><a style='color:orange;'href='candidateform.php?id=$r[0]'>$r[1]</td>";
                        echo "<td><a class='btn btn-danger' href='deletetitle.php?id=$r[0]'>Delete Record</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<h3 style='color:white; text-align:center'>No Title Found";
                }
                mysqli_close($link);
                ?>
            </div>
        </div>
        
    </body>
</html>
