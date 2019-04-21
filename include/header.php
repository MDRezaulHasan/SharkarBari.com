<!DOCTYPE html>
<html lang="en">
<head>
    <title>SharkarBari.Com </title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap dataTable-->
    <link href="assets/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/formValidation.css" rel="stylesheet" type="text/css"/>
    <link href="assets/style.css" rel="stylesheet" type="text/css"/> 
    
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="assets/js/jquery.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/formValidation.js" type="text/javascript"></script>
    <script src="assets/js/framework/bootstrap.js" type="text/javascript"></script>
    <!--Bootstrap DataTable SCRIPT-->
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="assets/js/responsive.bootstrap.min.js"></script>
    <script src="assets/script.js"></script>

    <!-- Owl stylesheet -->
    <link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/owl-carousel/owl.theme.css">
    <script src="assets/owl-carousel/owl.carousel.js"></script>
    <!-- Owl stylesheet -->

    <!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
    <script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>
    <!-- slitslider -->
    
    <!--Start of Tawk.to Script-->
    

</head>

<body>
    <!-- Header Starts -->
    <div class="navbar-wrapper">
        <div class="navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" style="padding: 6px 0;">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                </div>


                <!-- Nav Starts -->
                <div class="navbar-collapse  collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <?php
                        $path = $_SERVER['SCRIPT_FILENAME'];
                        $currentPage = basename($path,'.php');
                        ?>
                        <li <?php if ($currentPage == 'index') { echo 'class="active"';}?>><a href="index.php">Home</a></li>
                        <li <?php if ($currentPage == 'about') { echo 'class="active"';}?>><a href="about.php">About</a></li>
                        <li <?php if ($currentPage == 'owners') { echo 'class="active"';}?>><a href="owners.php">Owners</a></li>         
                        <li <?php if ($currentPage == 'contact') { echo 'class="active"';}?>><a href="contact.php">Contact</a></li>            
                    </ul>   
                </div>
                <?php
                        if((!isset($_SESSION['email'])) and (!isset($_SESSION['tenant_email'] ))){
                        ?>
                     
                            <div class="login-btn">
                                <a href="how-to-signin.php"><button type="button" class="btn btn-primary">Sign In</button></a>
                            </div>
                       
                        <?php }else{ ?>
                         
                            
                            <div class="dropdown my-account">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                                    <!--<strong><?php //if(isset($_SESSION['email']) ){echo $_SESSION['firstname']." ".$_SESSION['lastname'];}?></strong>-->
                                   
                                        <?php
                                        /*global $con;
                                        $owner_id = $_SESSION['owner_id'];
                                        $owner_email = $_SESSION['email'];
                                        $owner_name_query = "SELECT * FROM tbl_owner WHERE owner_id='$owner_id' AND email='$owner_email'";
                                        $run_query = mysqli_query($con, $owner_name_query);
                                        if($run_query){
                                            $owner_data_row = mysqli_fetch_array($run_query);
                                            echo $owner_data_row['firstname']." ".$owner_data_row['lastname'];
                                        }*/
                                        global $con;
                                        if(isset($_SESSION['email'])){
                                            $owner_id = $_SESSION['owner_id'];
                                            $owner_email = $_SESSION['email'];
                                            $owner_name_query = "SELECT * FROM tbl_owner WHERE owner_id='$owner_id' AND email='$owner_email'";
                                            $run_query = mysqli_query($con, $owner_name_query);
                                            if($run_query){
                                                $owner_data_row = mysqli_fetch_array($run_query);
                                                echo "<strong>".$owner_data_row['firstname']." ".$owner_data_row['lastname']."</strong>"
                                                        . "<span class='caret'></span></button>"
                                                        . "<ul class='dropdown-menu menu2' role='menu' aria-labelledby='menu1'>
                                                                <li role='presentation'><a role='menuitem' tabindex='-1' href='owner-account.php' style='color: black;'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
                                                                <li role='presentation'><a role='menuitem' tabindex='-1' href='signout.php?signout' style='color: black;'><span class='glyphicon glyphicon-off'></span> Logout</a></li>
                                                            </ul>";
                                                       
                                            }
                                        }elseif(isset($_SESSION['tenant_email'] )){
                                            $tenant_id = $_SESSION['tenant_id'];
                                            $tenant_email = $_SESSION['tenant_email'];
                                            $tenant_name_query = "SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id' AND tenant_email='$tenant_email'";
                                            $run_query = mysqli_query($con, $tenant_name_query);
                                            if($run_query){
                                                $tenant_data_row = mysqli_fetch_array($run_query);
                                                echo "<strong>".$tenant_data_row['tenant_name']."</strong>"
                                                        . "<span class='caret'></span></button>"
                                                        . "<ul class='dropdown-menu menu2' role='menu' aria-labelledby='menu1'>
                                                                <li role='presentation'><a role='menuitem' tabindex='-1' href='tenant-account.php' style='color: black;'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
                                                                <li role='presentation'><a role='menuitem' tabindex='-1' href='signout.php?signout_t' style='color: black;'><span class='glyphicon glyphicon-off'></span> Logout</a></li>
                                                            </ul>";
                                                       
                                            }
                                        }
                                        ?>
                                    
                                    <!--<span class="caret"></span></button>
                                <ul class="dropdown-menu menu2" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="owner-account.php" style="color: black;"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="signout.php?signout" style="color: black;"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                                </ul>-->
                            </div>
                        
                        <?php }?>
                
            
                <!-- #Nav Ends -->
            </div>
        </div>
    </div>
    <!-- #Header Starts -->

    <div class="container">
        <!-- Header Starts -->
        <div class="header">
        <a href="index.php"><img src="images/logo1.png" alt="Realestate"></a>
            <ul class="pull-right">
                <li><a href="buy.php">Buy</a></li>         
                <li><a href="rent.php">Rent</a></li>
            </ul>
        </div>
        <!-- #Header Starts -->
    </div>