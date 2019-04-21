<?php 
include 'inc/header.php';

?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-eye"></i>&nbsp; View Owner Notice
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
                        if(isset($_POST['ok'])){
                            echo "<script>window.location = 'owner-notice-to-tenant.php';</script>";
                        }
                        ?>
                        <?php
                        if(isset($_GET['view_owner_notice_id'])){
                            global $con;
                            $view_owner_notice_id = mysqli_real_escape_string($con,$_GET['view_owner_notice_id']);
                            $select_query = "SELECT tbl_owner_notice.*,tbl_owner.* FROM tbl_owner_notice INNER JOIN tbl_owner ON tbl_owner_notice.owner_id=tbl_owner.owner_id WHERE owner_notice_id='$view_owner_notice_id' ";
                            $result = mysqli_query($con, $select_query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)) {
                        ?>

                        
                        <form class="form-horizontal" action="" method="POST"id="form" >
                            
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>  
                                <div class="col-md-7">
                                   <input type="text" class="form-control input-md" value="<?php echo $row['firstname']." ".$row['lastname'];?>" readonly>
                                </div>
                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="add1">Notice</label>  
                                <div class="col-md-7">
                                    <textarea name="address" class="form-control"><?php echo $row['notice'];?></textarea>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date</label>  
                                <div class="col-md-7">
                                    <input  type="text" class="form-control input-md" value="<?php echo dateFormat($row['date']);?>" readonly>
                                </div>
                            </div>


                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="ok"></label>
                                <div class="col-md-7">
                                    <button id="ok" name="ok" class="btn btn-primary">OK</button>
                                </div>
                            </div>
                        </form>
                        <?php
                                }
                            }
                        }else{
                            echo "<script>window.location = 'owner-notice-to-tenant.php';</script>";
                        }
                        ?>
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

