<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';
require_once('mailer/class.phpmailer.php');
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['reply_msg_id']) || $_GET['reply_msg_id'] == NULL){
    header("Location:owner-account.php");
}else{    
    $msg_id = $_GET['reply_msg_id'];
}
global $con;
$owner_email = $_SESSION['email'];
include'include/header.php';

?>
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / Reply Message</span>
            <h2>Reply Message</h2>
        </div>
    </div>
    <!-- banner -->
    
    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">
                <?php
                $msg='';
                if(isset($_POST['send'])){
                    $toEmail = $_POST['toEmail'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];
                    
                    if(!empty($toEmail) || !empty($subject) || !empty($message)){
                        $msg = "<p style='background:#dff0d8;padding: 10px 0;font-weight: bold;text-align:center;'>Email Sent By <a style='text-decoration:none;color:#8b0000;'>$owner_email</a><br/> </p>".$message;
                        send_mail($toEmail,$msg,$subject);
                        $msg = "<div class='alert alert-success'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Success!</strong>  Email Sent Successfully.  
                            </div>";
                    }else{
                        $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                                </div>";
                    }
                }
                ?>
                <?php
                
                $query = "SELECT * FROM customer_message WHERE msg_id='$msg_id' AND owner_email='$owner_email'";
                $result = mysqli_query($con, $query);
                if($result){
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <form class="form-horizontal" action="" method="POST">
                    <?php
                    if(isset($msg))
                    {
                        echo $msg;               
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="toEmail">To Email</label>  
                        <div class="col-md-9">
                            <input id="toEmail" name="toEmail" type="email" value="<?php echo $row['customer_email'];?>" class="form-control input-md" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="subject">Subject</label>  
                        <div class="col-md-9">
                            <input id="subject" name="subject" type="text"  class="form-control input-md" >
                        </div>
                    </div>                   
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Message</label>  
                        <div class="col-md-9">
                            <textarea name="message" class="form-control tinymce" ></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-10 control-label" for="submit"></label>
                        <div class="col-md-2">
                            <button type="submit" name="send" class="btn btn-primary">SEND</button>            
                        </div>
                    </div>
                </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

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
<?php include'include/footer.php';?>