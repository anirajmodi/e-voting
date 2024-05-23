<?php
    session_start();
   $msg = "";
   if(isset($_POST['btnreg']))
   {
        $name = $_POST['txtname'];
        $pwd = $_POST['txtpwd'];
        $aadhar = $_POST['txtaadhar'];
        $gen = $_POST['gender'];
        $type = $_POST['usertype'];
        $link = mysqli_connect("localhost","root","","votingdb");
        $qry = "insert into voter(voter_name,voter_pwd,voter_aadhar,voter_gender,voter_type) values('$name','$pwd',$aadhar,'$gen','$type')";
        mysqli_query($link,$qry);
        if(mysqli_affected_rows($link)>0)
            $msg = "voter Register Successfully !!!!!!";
        else
            $msg = "Error in voter registration..........";
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
        <script>
            function ValidateForm()
            {
                flag = true;
                pwd = document.getElementById("q1").value;
                if(pwd.length<8)
                {
                    flag =false;
                    document.getElementById("a1").innerHTML ="Password minimum contain 8 character";
                }
                else if(pwd.length>=8)
                {
                    alph=0;
                    digit=0;
                    symbol=0;
                    for(i=0;i<pwd.length;i++)
                    {
                        ch = pwd.charAt(i);
                        if((ch>='A' && ch<='z')||(ch>='a'&& ch<='z'))
                            alph++;
                        else if(ch>='0'&& ch<='9')
                            digit++;
                        else
                            symbol++;
                    }
                    if(digit>=1 && alph>=1 && symbol>=1)
                    {
                        document.getElementById("a1").innerHTML ="";
                    }
                    else
                    {
                        document.getElementById("a1").innerHTML ="Password contain atleast 1 character, 1 digit, 1 symbol";
                        flag=false;
                    }
                }
                else
                    document.getElementById("a1").innerHTML ="";
                aadhar = document.getElementById("q2").value;
                if(aadhar.length!=12)
                {
                    document.getElementById("a2").innerHTML ="Invalid Aadhar Number !!!!!!";
                    flag = false;
                }
                else
                    document.getElementById("a2").innerHTML ="";
                return flag;
            }
            function ValidateAadhar()
            {
                id = document.getElementById("q2").value;
                obj = new XMLHttpRequest();
                obj.open("get","validateAadhar.php?aid="+id,true);
                obj.send();
                obj.onreadystatechange=function()
                {
                    if(obj.readyState==4 && obj.status==200)
                    {
                        document.getElementById("a2").innerHTML=obj.responseText;
                    }
                }
            }
        </script>
    </head>
    <body style="background-color:#165769;color:white;">
        <?php
        include'nav.php';
        ?>
        
        <div class="col-sm-3"></div>
        <div class="col-sm-6" style="padding-left:20px;">
            <h2>New Voter Registration</h2>
            <hr>
            <form method="POST" onsubmit = "return ValidateForm()">
                <div class="col-sm-3">Name</div>
            <div class="col-sm-9">
                <input required style="width:100%;color:black;border-radius:5px;"type="text" name="txtname" value=""><br><br>
            </div><div class="col-sm-3">Password</div>
            <div class="col-sm-9">
                <input id="q1" required style="width:100%;color:black;border-radius:5px;"type="password" name="txtpwd" value="">
                <label id="a1" style="color:red"></label>
            </div>
            <div class="col-sm-3">Aadhar Number</div>
            <div class="col-sm-9">
                <input id="q2" onchange="ValidateAadhar()" required style="width:100%;color:black;border-radius:5px;"type="number" name="txtaadhar" value="">
                <label id="a2" style="color:red"></label>
            </div>
            <div class="col-sm-3">Gender</div>
            <div class="col-sm-9">
                <input required type="radio" name="gender" value="Male"><label>Male</label>
                <input required type="radio" name="gender" value="Female"><label>Female</label><br><br>
            </div>
            <div class="col-sm-3">User Type</div>
            <div class="col-sm-9">
                <select required style="width:100%;color:black;border-radius:5px;" name="usertype">
                    <option></option>
                    <option>Admin</option>
                    <option>Voter</option>
                </select><br><br>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <input style="background-color:red;border-radius:5px;"type="submit" name="btnreg" value="Register">
            </div>
            <div style="text-align:center;color:greenyellow;">
                <?php
                    echo $msg;
                ?>
            </div>
            </form>
            
        </div>
        <div class="col-sm-3"></div>
        
    </body>
</html>
