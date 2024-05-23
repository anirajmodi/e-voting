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
            <div style="padding-left:20px;">
                <h2>View Result</h2>
                <hr>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Choose Election</label>
                            <div class="col-sm-6">
                                <select required class="form-control" name="etype">
                                    <option>Choose Election Type</option>
                                    <?php
                                        $link = mysqli_connect("localhost", "root","", "votingdb");
                                        $qry = "select * from election";
                                        $result = mysqli_query($link, $qry);
                                        while ($r = mysqli_fetch_array($result))
                                        {
                                            echo "<option value='$r[0]'>$r[1]</option>";
                                        }
                                        mysqli_close($link);
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="btnshow" value="Show Result" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <?php
                        if(isset($_POST['btnshow']))
                        {
                            $link=mysqli_connect("localhost","root","","votingdb");
                            $qry = "select x,y, cname from (Select count(voting_result.c_id) as x,(select c_name from candidate where c_id=voting_result.c_id) as y, (select cid from candidate where c_id=voting_result.c_id) as z from voting_result where pid=$_POST[etype] GROUP BY c_id) xy join category on category.cid=xy.z  ;";  
                            $result = mysqli_query($link, $qry);
                            echo "<table class='table table-hover' style='background-color:white;color:black;'>";
                            echo "<tr><th>Candidate Name</th><th>Total Votes</th><th>Category</th></tr>";
                            while($r = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                echo "<td>$r[1]</td>";
                                echo "<td>$r[0]</td>";
                                echo "<td>$r[2]</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($link);
                        }
                        ?>
            </div>
        </div>
        
        
    </body>
</html>
