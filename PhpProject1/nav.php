<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="container-fluid" >
            <div class="row" style="background-color:#30302f;">
                <div class="col-sm-6" style="color:yellow;padding-left:100px;">
                    <h3>e-voting</h3>
                    <label style="color:tomato;">
                        <?php
                        if(isset($_SESSION['uname']))
                            echo "welcome ".$_SESSION['uname'];
                        ?>
                    </label>
                </div>
                <div class="col-sm-6">
                    <nav style="padding-left:250px;">
                        <ul class="nav navbar-nav" style="background-color:black;border-radius:5px;">
                            <li><a href="home.php"style="color:green;">Home</a>
                            <?php
                            if(isset($_SESSION['uname']))
                            {
                                echo "<li><a href='vote.php'style='color:green;'>Vote</a>";
                            }
                            ?>
                            
                            <?php
                            if(isset($_SESSION['utype']))
                            {
                                if($_SESSION['utype']=='Admin')
                                {
                                    echo "<li ><a hrefclass='dropdown-toggle' data-toggle='dropdown'style='color:green;'>Admin<span class='caret'></span></a>";
                                    echo "<ul class='dropdown-menu'>";
                                    echo "<li><a href='categorylist.php'style='color:green;'>Category List</a></li>";
                                    echo "<li><a href='votinglist.php'style='color:green;'>Voting List</a></li>";
                                    echo "<li><a href='viewvoters.php'style='color:green;'>View Voters</a></li>";
                                    echo "<li><a href='addnewvoter.php'style='color:green;'>Add New Voter</a></li>";
                                echo "</ul>";
                                }
                            }
                            ?>
                            <li><a href="result.php"style="color:green;">View Result</a>
                            <?php
                                if(isset($_SESSION['uname']))
                                {
                                    echo "<li  class='active'><a style='color:green;' href='logout.php'>Logout</a></li>";
                                }
                            ?>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>