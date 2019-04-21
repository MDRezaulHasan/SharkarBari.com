<?php 
session_start();
if (isset($_SESSION['email']) == TRUE) {
    header("Location: index.php");
}
include '../database/db_connection.php';
include '../helpers/function.php';

if(isset($_POST['login'])){
    global $con;

    $email    = validate($_POST['email']);
    $password = validate($_POST['password']);

    $email    = mysqli_real_escape_string($con,$email);
    $password = mysqli_real_escape_string($con,$password);

    if(empty($email) || empty($password))
    {
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                </div>";
    }else{
        $password = md5($password);
        $query    = "SELECT * FROM tbl_admin WHERE email='$email' AND password='$password'";
        $result   = mysqli_query($con, $query);
        if($result){
            $row   = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result); 
            if($count > 0){
                    $_SESSION['id']            = $row['id'];
                    $_SESSION['username']      = $row['username'];
                    $_SESSION['email']         = $row['email'];
                    $_SESSION['profile_image'] = $row['profile_image'];
                    header("Location:index.php");                              
            }else{
                $msg = "<div class='alert alert-danger'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                            <strong>Error!</strong> Email or Password Not Matched.
                        </div>";
            }
        }else{
            $msg = "<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error!</strong> Email or Password Not Matched.
                    </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Page</title>
    <!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">	
	<!-- Metis core stylesheet -->
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="../assets/js/jquery.js"></script>
	<!--Bootstrap -->
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>	
</head>

<body class="login">

    <div class="form-signin">
        <div class="text-center">
            <img src="../images/logo.png" alt="bidwarbd Logo" style="width:100px;height:60px;">
        </div>
        <hr>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <?php
                if(isset($msg))
                {
                    echo $msg;               
                }
                ?>
                <form action="" method="post">
                    <p class="text-muted text-center">Enter your email and password</p>
                    
                    <input type="email" name="email" placeholder="email" class="form-control top">
                    <input type="password" name="password" placeholder="Password" class="form-control bottom">
                    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
                </form>
            </div>
        </div>
        <hr>  
    </div>
</body>

</html>
