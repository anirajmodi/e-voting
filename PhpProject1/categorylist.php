<?php
    session_start();
    $msg = "";
    if(isset($_POST['addcategory']))
    {
        $name = $_POST['categoryname'];
        $link = mysqli_connect("localhost","root","","votingdb");
        $qry = "insert into category(cname) values('$name')";
        mysqli_query($link,$qry);
        if(mysqli_affected_rows($link)>0)
            $msg = "category added Successfully !!!!!!";
        else
            $msg = "Error category not added..........";
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
            <div class="col-sm-6"style="padding-left:20px;">
                <h2>Add New Category</h2>
                <hr>
                <div class="col-sm-3" style="text-align:right;">
                    <label>Category name</label>
                </div>
                <form method="POST">
                    <div class="col-sm-9">
                        <input required style="width:100%;color:black;border-radius:5px;"type="text" name="categoryname" value=""><br><br>
                        <input style="background-color:red;border-radius:5px;" type="submit" name="addcategory" value="Add Category">
                        <div style="text-align:center;color:greenyellow;">
                            <?php
                                echo $msg;
                            ?>
                        </div>
                        
                    </div>
                </form>  
            </div>
            <div class="col-sm-6" style="padding-right:20px;">
                <h2>Category Lists</h2>
                <hr>
                <?php
                $link = mysqli_connect("localhost", "root","", "votingdb");
                $qry = "select * from category";
                $resultset = mysqli_query($link, $qry);
                if (mysqli_num_rows($resultset) > 0)
                {
                    echo "<div class='table-reponsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>S.No.</th><th>Category Name</th>";
                    echo "</tr>";
                    while($r= mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td><a class='btn btn-danger' href='deletecategory.php?id=$r[0]'>Delete Record</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<h3 style='color:white; text-align:center'>No Record Found";
                }
                mysqli_close($link);
                ?>
            </div>
        </div>
        
    </body>
</html>
