<?php 
session_start();
if (isset($_SESSION['email']) == TRUE) {
    header("Location: index.php");
}elseif (isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';

if(isset($_POST['submit'])){
    global $con;

    $email    = validate($_POST['email']);
    $email    = mysqli_real_escape_string($con,$email);
    
    if(empty($email)){
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error!</strong>Email Input Field Must Not Be Empty
                </div>";
    }else{
        $query = "SELECT * FROM tbl_owner WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con,$query);
        
        if($result){
            $row   = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result); 
            if($count > 0){
                if($row['status'] == "Y"){
                    if($row['ban'] == "0"){

                        $id=base64_encode($row['owner_id']);
                        $code = md5(uniqid(rand()));

                        $reset_query = "UPDATE tbl_owner SET code='$code' WHERE email='$email'";
                        $update_code = mysqli_query($con,$reset_query);

                        $message= "Hello , $email
                                    <br /><br />
                                    We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,
                                    <br /><br />
                                    Click Following Link To Reset Your Password 
                                    <br /><br />
                                    <a href='http://localhost/sharkarbari.com/reset-password-owner.php?id=$id&&code=$code'>click here to reset your password</a>
                                    <br /><br />
                                    thank you  ";
                        $subject = "Password Reset";

                        send_mail($email,$message,$subject);

                        $msg = "<div class='alert alert-success'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    We've sent an email to $email.
                                    Please click on the password reset link in the email to generate new password. 
                                </div>";
                    }
                }
            }else{
                $msg = "<div class='alert alert-danger'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                            <strong>Sorry!</strong>  this email not found. 
                        </div>";
            }
            
        }
    }
    
}

include'include/header.php';
?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Forgot Password</span>
          <h2>Forgot Password</h2>
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
                        else
                        {
                    ?>
                    <div class='alert alert-info'>
                        Please enter your email address. You will receive a link to create a new password via email.!
                    </div>  
                    <?php
                    }
                    ?>
                    <form class="form-horizontal" action="" method="POST" >
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="email">Email</label>  
                            <div class="col-md-5">
                                <input id="email" name="email" type="email" class="form-control input-md" >
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="submit"></label> 
                            <div class="col-md-5">
                                <button id="submit" name="submit" class="btn btn-primary">Generate new Password</button>                       
                            </div>
                        </div>
                    </form>
                </div>              
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>


