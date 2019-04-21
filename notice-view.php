<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['notice_id']) || $_GET['notice_id'] == NULL){
    header("Location:owner-account.php");
}else{    
    $notice_id = $_GET['notice_id'];
}

include'include/header.php';

?>

    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / View Notice</span>
            <h2>View Notice</h2>
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
                $query = "SELECT * FROM tbl_tenant_notice WHERE tenant_notice_id='$notice_id'";
                $result = mysqli_query($con, $query);
                if($result){
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                              
                <form class="form-horizontal" action="" method="POST">
                  
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="tenant_name">Tenant Name</label>  
                        <div class="col-md-9">
                            <input id="tenant_name" name="tenant_name" type="text" value="<?php echo $row['tenant_name'];?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="tenant_email">Tenant Email</label>  
                        <div class="col-md-9">
                            <input id="tenant_email" name="tenant_email" type="email" value="<?php echo $row['tenant_email'];?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="building_name">Building Name</label>  
                        <div class="col-md-9">
                            <input id="building_name" name="building_name" type="text" value="<?php echo $row['building_name'];?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                        <div class="col-md-9">
                            <input id="floor_num" name="floor_num" type="text" value="<?php echo $row['floor_num'];?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                        <div class="col-md-9">
                            <input id="flat_num" name="flat_num" type="text" value="<?php echo $row['flat_num'];?>" class="form-control input-md" readonly>
                        </div>
                    </div> 
                    
                    
                    
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



