<?php
session_start();
$msg = "";
if (isset($_POST['btnvote'])) {
    $p = $_POST['p1'];
    $vp = $_POST['p2'];
    $gs = $_POST['p3'];
    $js = $_POST['p4'];
    $qry1 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$p,$_SESSION[pid])";
    $qry2 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$vp,$_SESSION[pid])";
    $qry3 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$gs,$_SESSION[pid])";
    $qry4 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$js,$_SESSION[pid])";
    $link = mysqli_connect("localhost", "root", "", "votingdb");
    mysqli_query($link, $qry1);
    mysqli_query($link, $qry2);
    mysqli_query($link, $qry3);
    mysqli_query($link, $qry4);
    if (mysqli_affected_rows($link) > 0)
        $msg = "<font color='orange'>Your Vote Is Successfully Casted !!!!!!</font>";
    else
        $msg = "<font color='orange'>Error in casting the vote!!!!!!</font>";
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
            <div style="padding-left:20px;">
                <h2 valign="bottom">Cast Your vote</h2>
                <hr>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Choose Election</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="etype">
                                    <option>Choose Election Type</option>
                                    <?php
                                    $link = mysqli_connect("localhost", "root", "", "votingdb");
                                    $qry = "select * from election";
                                    $result = mysqli_query($link, $qry);
                                    while ($r = mysqli_fetch_array($result)) {
                                        echo "<option value='$r[0]'>$r[1]</option>";
                                    }
                                    mysqli_close($link);
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="btnshow" value="show" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
        <form method="post">
<?php
if (isset($_POST['btnshow'])) {
    $id = $_POST['etype'];
    $_SESSION['pid'] = $id;
    $link = mysqli_connect("localhost", "root", "", "votingdb");
    $res = mysqli_query($link, "select * from voting_result where voter_id=$_SESSION[vid] and pid=$id");
    if (mysqli_num_rows($res) == 0) {
        $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='President')";
        $result = mysqli_query($link, $qry);
        echo "<div class='row'><div class='col-sm-12'><h3 style='color:yellow; padding-left:30px'>President</h3></div></div>";
        echo "<div class='row text-center'>";
        echo "<div class='col-sm-1'></div>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<div class='col-sm-2'>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<img src='$r[2]' width='100px' height='100px'/>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<label>$r[1]</label>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<input type='radio' name='p1' value='$r[0]'/>";
            echo "</div></div>";
            echo "</div>";
        }
        echo "</div>";
        $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='Vice-President');";
        $result = mysqli_query($link, $qry);
        echo "<div class='row'><div class='col-sm-12'><h3 style='color:yellow; padding-left:30px'>Vice-President</h3></div></div>";
        echo "<div class='row text-center'>";
        echo "<div class='col-sm-1'></div>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<div class='col-sm-2'>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<img src='$r[2]' width='100px' height='100px'/>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<label  style='color:white'>$r[1]</label>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<input type='radio' name='p2' value='$r[0]'/>";
            echo "</div></div>";
            echo "</div>";
        }
        echo "</div>";
        $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='General Secretary');";
        $result = mysqli_query($link, $qry);
        echo "<div class='row'><div class='col-sm-12'><h3 style='color:yellow; padding-left:30px'>General Secretary</h3></div></div>";
        echo "<div class='row text-center'>";
        echo "<div class='col-sm-1'></div>";
        while ($r = mysqli_fetch_array($result)) {

            echo "<div class='col-sm-2'>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<img src='$r[2]' width='100px' height='100px'/>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<label style='color:white'>$r[1]</label>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<input type='radio' name='p3' value='$r[0]'/>";
            echo "</div></div>";
            echo "</div>";
        }
        echo "</div>";
        $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='Joint Secretary');";
        $result = mysqli_query($link, $qry);
        echo "<div class='row'><div class='col-sm-12'><h3 style='color:yellow; padding-left:30px'>Joint Secretary</h3></div></div>";
        echo "<div class='row text-center'>";
        echo "<div class='col-sm-1'></div>";
        while ($r = mysqli_fetch_array($result)) {

            echo "<div class='col-sm-2'>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<img src='$r[2]' width='100px' height='100px'/>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<label style='color:white'>$r[1]</label>";
            echo "</div></div>";
            echo "<div class='row'><div class='col-sm-12'>";
            echo "<input type='radio' name='p4' value='$r[0]'/>";
            echo "</div></div>";
            echo "</div>";
        }
        echo "</div>";
        
        echo "<input class='btn btn-danger' style='margin-left:50px' type='submit' name='btnvote' value='Give Vote'/>";
    }
 else {
        echo "<div style='color:yellow'>you already cast your vote!!!!</div>";
    }
    mysqli_close($link);
}
echo $msg;
?>
        </form>


    </body>
</html>
