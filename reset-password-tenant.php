<?php 
session_start();
if (isset($_SESSION['email']) == TRUE) {
    header("Location: index.php");
}elseif (isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';


if(isset($_GET['id']) && isset($_GET['code']))
{
    global $con;
    
    $id = base64_decode($_GET['id']);
    
    $code = $_GET['code'];
   
    $query = "SELECT * FROM tbl_tenant WHERE tenant_id='$id' AND code='$code' LIMIT 1";
    $result = mysqli_query($con,$query);
    if($result){
        $row = mysqli_fetch_array($result);
        $tenant_id = $row['tenant_id'];
            if(isset($_POST['reset_tenant_password'])){
                $new_password = validate($_POST['new_password']);
                $confirm_password = validate($_POST['cf_password']);
                
                $new_password = mysqli_real_escape_string($con,$new_password);
                $confirm_password = mysqli_real_escape_string($con,$confirm_password);
                
                if(empty($new_password) || empty($confirm_password)){
                    $msg = "<div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error!</strong>Password Filed Must Not Be Empty
                            </div>";
                } elseif ($confirm_password!==$new_password) {
                     $msg = "<div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error!</strong> Confirm Password Not Matched With New Password
                            </div>";
                }else{
                    $tenant_password  = md5($confirm_password);
                    $update_password_query = "UPDATE tbl_tenant SET tenant_password='$tenant_password' WHERE tenant_id='$tenant_id'";
                    $update_query = mysqli_query($con,$update_password_query);
                    if($update_query){
                        $msg = "<div class='alert alert-success'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    Password Changed Successfully.
                                </div>";
                        header("refresh:5;index.php");
                    }
                }
                
            }
        
    }
}else{
    header("Location: 404.php");
}

include'include/header.php';
?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Reset Password</span>
          <h2>Reset Password</h2>
        </div>
    </div>
    <!-- banner -->


    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if(isset($msg))
                    {
                        echo $msg;
                    }
                    ?>
                    <form class="form-horizontal" action="" method="POST" >
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="password">New Password</label>  
                            <div class="col-md-5">
                                <input id="password" name="new_password" type="password"  class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="cfpassword">Confirm Password</label>  
                            <div class="col-md-5">
                                <input id="cfpassword" name="cf_password" type="password" class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="submit"></label> 
                            <div class="col-md-5">
                                <button id="submit" name="reset_tenant_password" class="btn btn-primary">Reset Password</button>                       
                            </div>
                        </div>
                    </form>
                </div>              
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>
