<?php 
session_start();
if (isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(empty($_GET['email']) && empty($_GET['code'])){
    header("Location:404.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';



if(isset($_GET['email']) && isset($_GET['code'])){
    global  $con;
    
    $email = $_GET['email'];
    $code = $_GET['code'];
    
    $statusY = "Y";
    $statusN = "N";
    
    $query = "SELECT tenant_email,status FROM  tbl_tenant WHERE tenant_email='$email' AND code='$code' LIMIT 1";
    $result = mysqli_query($con, $query);
    if($result){
        
        $row   = mysqli_fetch_array($result);
        if($row['status'] == $statusN){
            $update_query = "UPDATE tbl_tenant SET status='$statusY' WHERE tenant_email='$email' and code='$code'";
            $run_update_query = mysqli_query($con, $update_query);
            
            if($run_update_query){
                $msg = "<div class='alert alert-success' role='alert'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>WOW !</strong>  Your Account is Now Activated : <a href='tenant-signin.php'>Sign In here</a>
                    </div>";
            }            	
        }else{
            $msg = "<div class='alert alert-danger' role='alert'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Sorry !</strong>  Your Account is allready Activated : <a href='tenant-signin.php'>Sign In here</a>
                    </div>";
        }
        	
    }
    else{
        $msg = "<div class='alert alert-danger' role='alert'>
                   <button class='close' data-dismiss='alert'>&times;</button>
                   <strong>Sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
                </div> ";
    }
}
?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Account Verify</span>
          <h2>Account Verify</h2>
        </div>
    </div>
    <!-- banner -->


    <section class="container-fluid account-verify-section">
        <div class="container">
            <div class="row">
                <?php
                if(isset($msg))
                {
                    echo $msg;               
                }
                ?>
                
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>






