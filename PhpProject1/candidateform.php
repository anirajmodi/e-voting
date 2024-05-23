<?php
    session_start();
    $msg = "";
    if(isset($_POST['btnreg']))
    {
        $name = $_POST['cname'];
        $path = "";
        if($_FILES['cimage']['error']==0)
        {
            $from = $_FILES['cimage']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT']."/PhpProject1/picture/".$_FILES['cimage']['name'];
            move_uploaded_file($from, $to);
            $path = "picture/".$_FILES['cimage']['name'];
        }
        $catg = $_POST['category'];
        $pid = $_POST['pid'];
        $link = mysqli_connect("localhost","root","","votingdb");
        $qry = "insert into candidate(c_name,c_image,cid,pid) values('$name','$path',$catg, $pid)";
        mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)>0)
            $msg = "candidate register successfully";
        else     
            $msg ="Error in registration";
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
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>"/>
                    <h2>Candidate Form</h2>
                    <hr>
                    <div>
                        <div class="col-sm-3" style="text-align:right;">
                            <label>Candidate Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input required style="width:100%;color:black;border-radius:5px;" type="text" name="cname" value=""><br><br>
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-3" style="text-align:right;">
                            <label>Election Symbol</label>
                        </div>
                        <div class="col-sm-9">
                            <input required style="width:100%;background-color:white;color:black;border-radius:5px;" type="file" name="cimage" ><br>
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-3" style="text-align:right;">
                            <label>Select Category</label>
                        </div>
                        <div class="col-sm-9">
                            <select required style="width:100%;color:black;border-radius:5px;" name="category">
                            <?php
                                $link = mysqli_connect("localhost","root","","votingdb");
                                $qry = "select * from category";
                                $resultset = mysqli_query($link, $qry);
                                if(mysqli_num_rows($resultset)>0)
                                {
                                    echo "<option></option>";
                                    while ($r = mysqli_fetch_array($resultset))
                                    {        
                                        echo "<option value='$r[0]'>$r[1]</option>";
                                    }
                                }
                                mysqli_close($link);
                                
                            ?>
                            </select><br><br>
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input style="background-color:red;border-radius:5px;" type="submit" name="btnreg" value="save">
                        </div>    
                    </div>
                    <div style="text-align:center;color:orange;">
                        <?php echo  $msg; ?>
                    </div>
                    
                </form>
            </div>
            <div class="col-sm-6" style="padding-right:20px;">
                <h2>View Candidates</h2>
                <hr>
                <?php
                $link = mysqli_connect("localhost", "root","", "votingdb");
                $qry = "select * from candidate";
                $resultset = mysqli_query($link, $qry);
                if (mysqli_num_rows($resultset) > 0)
                {
                    echo "<div class='table-reponsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>S.No.</th><th>Candidate Name</th><th>Election symbol</th><th>Category</th>";
                    echo "</tr>";
                    while($r= mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td>$r[2]</td>";
                        echo "<td>$r[3]</td>";
                        echo "<td><a class='btn btn-danger' href='deletecandidate.php?id=$r[0]'>Delete Record</td>";
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
