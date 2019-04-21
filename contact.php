<?php 
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / Contact Us</span>
            <h2>Contact Us</h2>
        </div>
    </div>
    <!-- banner -->


    <div class="container">
        <div class="spacer">
            <div class="row contact">
                <div class="col-lg-6 col-sm-6 ">
                    <?php
                        if(isset($_POST['send_message'])){
                            global $con;

                            $fullname = validate($_POST['fullname']);
                            $fullname = mysqli_real_escape_string($con,$fullname);

                            $email = validate($_POST['email']);
                            $email = mysqli_real_escape_string($con,$email);

                            $phone_number = validate($_POST['phone_number']);
                            $phone_number = mysqli_real_escape_string($con,$phone_number);

                            $message = validate($_POST['message']);
                            $message = mysqli_real_escape_string($con,$message);

                            if(empty($fullname) || empty($email) || empty($phone_number) || empty($message)){
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.
                                        </div>";
                            }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Error!</strong> Invalid Email Address.
                                        </div>";
                            }else{
                                $message_query = "INSERT INTO tbl_contact_msg(fullname,email,phone_number,message) VALUES('$fullname','$email','$phone_number','$message')";
                                $send_message  = mysqli_query($con,$message_query);
                                if($send_message){
                                    $msg = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Success!</strong>  Your Message Sent Successfully.  
                                            </div>";
                                }else{
                                    $msg = "<div class='alert alert-danger'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Error!</strong>  Your Message Not Sent.  
                                            </div>";
                                }
                            }


                        }
                        ?>
                        <?php
                        if(isset($msg))
                        {
                            echo $msg;               
                        }
                        ?>
                        <form role="form" action="" method="post">
                            <input type="text" name="fullname" class="form-control" placeholder="Enter Your Full Name"/>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email"/>
                            <input type="number" name="phone_number" class="form-control" placeholder="Enter Your Phone Number"/>
                            <textarea rows="6" name="message" class="form-control" placeholder="Enter Whats on your mind?"></textarea>
                            <button type="submit" class="btn btn-primary" name="send_message">Send</button>
                        </form>                                 
                </div>
                <div class="col-lg-6 col-sm-6 ">
                    <div class="well">
                        <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pulchowk,+Patan,+Central+Region,+Nepal&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Pulchowk,+Patan+Dhoka,+Patan,+Bagmati,+Central+Region,+Nepal&amp;ll=27.678236,85.316853&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include'include/footer.php';?>