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
        $query    = "SELECT * FROM tbl_tenant WHERE tenant_email='$email' AND tenant_password='$password'";
        $result   = mysqli_query($con, $query);
        if($result){
            $row   = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result); 
            if($count > 0){
                if($row['status'] == "Y"){
                    if($row['ban'] == "0"){
                        $_SESSION['tenant_id']  = $row['tenant_id'];
                        $_SESSION['tenant_name'] = $row['tenant_name'];
                        $_SESSION['tenant_email']     = $row['tenant_email'];
                        $_SESSION['tenant_phone']     = $row['tenant_phone'];
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
                <div class="col-md-12 tenant-sign-in-form">
                    
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
                            <div class="col-md-7">
                                <input id="email" name="email" type="email" class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">Password</label>  
                            <div class="col-md-7">
                                <input id="password" name="password" type="password"  class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="submit"></label>
                            <div class="col-md-7">
                                <button id="submit" name="signin" class="btn btn-primary">SIGN IN</button>                       
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="submit"></label>
                            <div class="col-md-7"  style="text-align: right;">
                                <a href="forgot-password-tenant.php">Lost your Password ? </a>                    
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>

