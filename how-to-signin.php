<?php 
session_start();
if (isset($_SESSION['email']) == TRUE) {
    header("Location: index.php");
}elseif (isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';


include'include/header.php';
?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / How You Want To Sign In?</span>
          <h2>How You Want To Sign In?</h2>
        </div>
    </div>
    <!-- banner -->
    

    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 sign-up" style="text-align: center;">
                    <h3 style="font-weight: bold;">How do you want to sign in?</h3>
                    <p>If you want to sign in as a tenant click on tenant sign in button otherwise click on owner sign in button.</p>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='tenant-signin.php'" style="width:200px;">Tenant Sign In</button>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='signin.php'" style="width:200px;">Owner Sign In</button>
                </div>
                
            </div>
        </div>
    </section>


<?php include'include/footer.php';?>