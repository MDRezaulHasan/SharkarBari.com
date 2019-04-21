<?php 
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
?>

<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> / About Us</span>
    <h2>About Us</h2>
</div>
</div>
<!-- banner -->


<div class="container">
    <div class="spacer">
        <div class="row">
            <div class="col-lg-8  col-lg-offset-2">
                <img src="images/about-us.jpg" class="img-responsive thumbnail"  alt="realestate">
                <h3>Business Background</h3>
                <p>At this present age of modern technology, every single system is converting into computerized system due to different benefit features. The main aim of the project is to develop software for the automation (easiest more efficient use) of rental management system. We tried to develop a system, which will ensure some aspects such as reliability, maintainability, cost-effectiveness, security and nice user-friendly environment.</p>
                <h3>How to send ads money?</h3>
                <p> After giving the ads send 500Tk for each ads. Send money to our Bkash number +8801682100568. After receiving the money we will publish your ads in our website.</p>
                </div>

        </div>
    </div>
</div>

<?php include'include/footer.php';?>