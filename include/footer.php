<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Information</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="owners.php">Owners</a></li>         
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                <h4>Newsletter</h4>
                <p>Get notified about the latest properties in our marketplace.</p>
                <?php
                if(isset($_POST['notify_me'])){
                    $newsletter_email = validate($_POST['email']);

                    $newsletter_email = mysqli_real_escape_string($con,$newsletter_email);
                    $email_query = "SELECT * FROM tbl_newsletter WHERE email='$newsletter_email'";
                    $result = mysqli_query($con, $email_query);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        $msg1 = " <div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Sorry !</strong>  Email allready in newsletter list , Please Try another one
                                </div>";
                    }elseif(empty ($newsletter_email))
                    {

                        $msg1 = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong>Email Input Field Must Not Be Empty.
                                </div>";
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $msg1 = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Error!</strong> Invalid Email Address.
                                </div>";
                    }else{
                        $query = "INSERT INTO tbl_newsletter(email) VALUES('$email')";

                       $insert_data = mysqli_query($con,$query);
                       if ($insert_data) {
                           $msg1 = "<div class='alert alert-success'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Success!</strong>  Your Email Successfully Added TO Our Newsletter List 
                                    </div>
                                    ";
                       }
                    }
                }
                ?>
                <form class="form-inline" role="form" action="" method="post">
                     <?php
                    if(isset($msg1))
                    {
                        echo $msg1;               
                    }
                    ?>
                    <input type="text" name="email" placeholder="Enter Your email address" class="form-control" style="width: 100%;">
                    <button class="btn btn-success" type="submit" name="notify_me">Notify Me!</button>
                </form>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                <h4>Follow us</h4>
                <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                <a href="#"><img src="images/linkedin.png" alt="linkedin"></a>
                <a href="#"><img src="images/instagram.png" alt="instagram"></a>
            </div>

             <div class="col-lg-3 col-sm-3">
                <h4>Contact us</h4>
                <p><b>Bootstrap Realestate Inc.</b><br>
                <span class="glyphicon glyphicon-map-marker"></span> Sharkarbar, Bow bazar, Chittagong <br>
                <span class="glyphicon glyphicon-envelope"></span> sharkarbari@gmail.com<br>
                <span class="glyphicon glyphicon-earphone"></span> +8801682100568</p>
            </div>
        </div>
        <p class="copyright">Copyright 2017. All rights reserved Sharkarbari.	</p>
    </div>
</div>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59f881554854b82732ff9274/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script>
$(document).ready(function() {
    $("[data-toggle=tooltip]").tooltip();
} );
</script>
</body>
</html>


