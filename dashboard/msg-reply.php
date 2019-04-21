<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-eye"></i>&nbsp; View Message
        </h3>
    </div>
    <!--In Which Page We Are Name Section End-->

<?php include 'inc/sidebar.php';?>
    
    <!--Main Body Content Section Start-->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">                                              
                <div class="row">
                    <div class="col-md-12 text-align-left"   style="margin-top:50px;margin-bottom: 50px;">
                         <?php
                        if(isset($_POST['send'])){
                            $email = validate($_POST['email']);
                            $email = mysqli_real_escape_string($con,$email);
                            
                            $subject = validate($_POST['subject']);
                            $subject = mysqli_real_escape_string($con,$subject);
                            
                            $message =$_POST['message'];
                            
                            if(empty($email) || empty($subject) || empty($message)){
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.
                                        </div>";
                            } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Error!</strong> Invalid Email Address.
                                        </div>";
                            } else{
                                reply_mail($email,$message,$subject);
                                $msg = "<div class='alert alert-success'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Success!</strong> Message Successfully sent to $email.
                                        </div>";
                            }                                                     
                        }
                        ?>
                        <?php
                        if(isset($_GET['reply_msg_id'])){
                            $msg_id = mysqli_real_escape_string($con,$_GET['reply_msg_id']);

                            $query = "SELECT * FROM tbl_contact_msg WHERE id='$msg_id'";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $row = mysqli_fetch_array($result);
                            }
                        }
                        ?>

                        <form class="form-horizontal" action="" method="POST">
                            <?php
                            if(isset($msg)){
                                echo $msg;
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="toEmail">To Email</label>  
                                <div class="col-md-7">
                                    <input id="toEmail" name="email" type="email" value="<?php echo $row['email'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="subject">Subject</label>  
                                <div class="col-md-7">
                                    <input id="subject" name="subject" type="text"  class="form-control input-md" >
                                </div>
                            </div>                   

                            <div class="form-group">
                                <label class="col-md-2 control-label">Message</label>  
                                <div class="col-md-7">
                                    <textarea name="message" class="form-control tinymce" ></textarea>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="send"></label>
                                <div class="col-md-7">
                                    <button type="submit" id="send" name="send" class="btn btn-primary">SEND</button>
                                </div>
                            </div>
                        </form>
 
                    </div>
                </div>                       
            </div>
        </div>
    </div>
    <!--Main Body Content Section End-->
    
<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b8jn5oxw2wsq20pm7uc2nnu56ea992nztzxossmob6lhj56j'></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 200,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [


        ]
    });
</script>
<?php include 'inc/footer.php';?>	



