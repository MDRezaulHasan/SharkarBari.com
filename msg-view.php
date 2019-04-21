<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['msg_id']) || $_GET['msg_id'] == NULL){
    header("Location:owner-account.php");
}else{    
    $msg_id = $_GET['msg_id'];
}

include'include/header.php';

?>

    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / View Message</span>
            <h2>View Message</h2>
        </div>
    </div>
    <!-- banner -->
    
    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">
                <?php
                if(isset($_POST['ok'])){
                    echo "<script>window.location = 'owner-account.php';</script>";
                }
                ?>
                <?php
                global $con;
                $query = "SELECT * FROM customer_message WHERE msg_id='$msg_id'";
                $result = mysqli_query($con, $query);
                if($result){
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                              
                <form class="form-horizontal" action="" method="POST">
                        
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="customer_name">Name</label>  
                        <div class="col-md-9">
                            <input id="customer_name" name="customer_name" type="text" value="<?php echo $row['customer_name'];?>" class="form-control input-md" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="customer_email">Email From</label>  
                        <div class="col-md-9">
                            <input id="customer_email" name="customer_email" type="email" value="<?php echo $row['customer_email'];?>" class="form-control input-md" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="customer_phone_num">Phone Number</label>  
                        <div class="col-md-9">
                            <input id="customer_phone_num" name="customer_phone_num" type="text" value="<?php echo "+880".$row['customer_phone_num'];?>" class="form-control input-md" readonly>
                        </div>
                    </div>                   
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Message</label>  
                        <div class="col-md-9">
                            <textarea name="customer_message" class="form-control tinymce" readonly><?php echo $row['customer_message'];?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="date">Date</label>  
                        <div class="col-md-9">
                            <input id="date" name="date" type="text" value="<?php echo dateFormat($row['date']);?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-md-10 control-label" for="submit"></label>
                        <div class="col-md-2">
                            <button type="submit" name="ok" class="btn btn-primary">OK</button>            
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