<?php 
session_start();
if (isset($_SESSION['email']) == TRUE) {
    header("Location: index.php");
}elseif (isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';


if(isset($_POST['signin'])){
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
        $query    = "SELECT * FROM tbl_owner WHERE email='$email' AND password='$password'";
        $result   = mysqli_query($con, $query);
        if($result){
            $row   = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result); 
            if($count > 0){
                if($row['status'] == "Y"){
                    if($row['ban'] == "0"){
                        $_SESSION['owner_id']  = $row['owner_id'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname']  = $row['lastname'];
                        $_SESSION['email']     = $row['email'];
                        $_SESSION['phone']     = $row['phone'];
                        echo "<script>window.location = 'index.php';</script>";  
                    } else {
                        $msg = "<div class='alert alert-warning'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Sorry!</strong> This Account is Blocked.
                                </div>";
                    }                    
                }else{
                    $msg = "<div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
                            </div>";
                }                
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

include'include/header.php';



?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Sign In</span>
          <h2>SIGN IN</h2>
        </div>
    </div>
    <!-- banner -->


    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 sign-in-form">
                    
                    <form class="form-horizontal" action="" method="POST" >
                        <?php
                        if(isset($msg))
                        {
                            echo $msg;               
                        }
                        ?>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="email">Email</label>  
                            <div class="col-md-8">
                                <input id="email" name="email" type="email" class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">Password</label>  
                            <div class="col-md-8">
                                <input id="password" name="password" type="password"  class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="submit"></label>
                            <div class="col-md-8">
                                <button id="submit" name="signin" class="btn btn-primary">SIGN IN</button>                       
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="submit"></label>
                            <div class="col-md-8"  style="text-align: right;">
                                <a href="forgot-password-owner.php">Lost your Password ? </a>                    
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 sign-up" style="text-align: center;">
                    <h3 style="font-weight: bold;">New Owner Sign Up</h3>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='signup.php'" style="width:200px;margin-top: 30px;">Owner Join</button>
                </div>
                
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>
