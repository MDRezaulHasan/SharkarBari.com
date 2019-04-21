<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

global $con;
if (!isset($_SESSION['tenant_email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['personal_notice_id']) || $_GET['personal_notice_id'] == NULL){
    header("Location:tenant-account.php");
}else{    
    $personal_notice_id = mysqli_real_escape_string($con,$_GET['personal_notice_id']);
}

include'include/header.php';

?>

    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / View Personal Notice</span>
            <h2>View Personal Notice</h2>
        </div>
    </div>
    <!-- banner -->
    
    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">
                <?php
                if(isset($_POST['ok'])){
                    echo "<script>window.location = 'tenant-account.php';</script>";
                }
                ?>
                <?php
 
                $query = "SELECT * FROM tbl_owner_to_tenant_personal_notice WHERE notice_id='$personal_notice_id'";
                $result = mysqli_query($con, $query);
                if($result){
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                              
                <form class="form-horizontal" action="" method="POST">
                  
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Notice</label>  
                        <div class="col-md-9">
                            <textarea name="notice" class="form-control tinymce" readonly><?php echo $row['notice'];?></textarea>
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

