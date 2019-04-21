<?php 
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Owners</span>
          <h2>Owners</h2>
        </div>
    </div>
    <!-- banner -->


    <div class="container">
        <div class="spacer agents"></div>
        <div class="row">
            <div class="col-lg-8  col-lg-offset-2 col-sm-12" style="padding-bottom: 30px;">
                
                <?php
                global $con;
                $query  = "SELECT * FROM tbl_owner";
                $result = mysqli_query($con, $query);
                if($result)
                {
                    while ($row = mysqli_fetch_array($result))
                    {
                ?>
                        <div class="row" style="padding: 20px 0;">
                            <div class="col-lg-2 col-sm-2 ">
                                <img src="<?php echo $row['profile_image'];?>" class="img-responsive"  alt="agent name">
                            </div>
                            <div class="col-lg-5 col-sm-5 ">
                                <h4><?php echo $row['firstname']." ".$row['lastname'];?></h4>
                                <p><?php echo $row['address'];?></p>
                            </div>
                            <div class="col-lg-5 col-sm-5 ">
                                <span class="glyphicon glyphicon-envelope"></span> <?php echo $row['email'];?><br>
                                <span class="glyphicon glyphicon-earphone"></span> +880<?php echo $row['phone'];?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                
            
            </div>
        </div>
    </div>

<?php include'include/footer.php';?>