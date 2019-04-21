<?php 
session_start();
if (!isset($_SESSION['email']) == TRUE) {
    header("Location: login.php");
}
include '../database/db_connection.php';
include '../helpers/function.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <!--IE Compatibility modes-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Mobile first-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Dashboard || BidWarBd</title>
        <!-- Bootstrap -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap dataTable-->
        <link href="../assets/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Main Style-->
        <link href="assets/css/main.css" rel="stylesheet" type="text/css"/>
        
    </head>
	<body>
        <div class="bg-dark dk" id="wrap">
            <div id="top">
                <!-- NAVBAR(EMAIL, MESSAGE, LOGOUT BUTTON AND TOGGLE BUTTON) START-->
                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container-fluid">				
                        <!--LOGO IMAGE-->
                        <header class="navbar-header">			
                            <a href="index.html" class="navbar-brand"><img src="assets/img/logo.png" alt="sharkarbari Logo"></a>				
                        </header>				
                        <!--/LOGO IMAGE-->

                        <div class="topnav">
                            <div class="btn-group">
                                <a href="inbox.php" data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                                    <i class="fa fa-envelope"></i>
                                    <span class="label label-warning">
                                        <?php
                                        if(isset($_SESSION['email'])){
                                            global $con;
                                            $inbox_query = "SELECT * FROM tbl_contact_msg WHERE status='0'";
                                            $inbox_run_query  = mysqli_query($con, $inbox_query);
                                            if($inbox_run_query){
                                                $count = mysqli_num_rows($inbox_run_query);
                                                echo "(".$count.")";
                                            }else{
                                                echo "(0)";
                                            }
                                        }
                                        ?>
                                    </span>
                                </a>	
                            </div>
                            <div class="btn-group">
                                <a href="logout.php?logout" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>				
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </nav>
                <!-- /NAVBAR END-->
                <!--HEADER(SEARCH BAR AND PAGE TITLE)-->
                <header class="head">
                    
                    <!-- /.search-bar -->
                