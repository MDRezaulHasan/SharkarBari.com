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
                        if(isset($_POST['ok'])){
                            echo "<script>window.location = 'inbox.php';</script>";
                        }
                        ?>
                        <?php
                        if(isset($_GET['msg_view_id'])){
                            $msg_id = mysqli_real_escape_string($con,$_GET['msg_view_id']);

                            $query = "SELECT * FROM tbl_contact_msg WHERE id='$msg_id'";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <form class="form-horizontal" action="" method="POST">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="customer_name">Name</label>  
                                <div class="col-md-7">
                                    <input id="customer_name" name="customer_name" type="text" value="<?php echo $row['fullname'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="customer_email">Email From</label>  
                                <div class="col-md-7">
                                    <input id="customer_email" name="customer_email" type="email" value="<?php echo $row['email'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="customer_phone_num">Phone Number</label>  
                                <div class="col-md-7">
                                    <input id="customer_phone_num" name="customer_phone_num" type="text" value="<?php echo "+880".$row['phone_number'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>                   

                            <div class="form-group">
                                <label class="col-md-2 control-label">Message</label>  
                                <div class="col-md-7">
                                    <textarea name="customer_message" class="form-control tinymce" readonly><?php echo $row['message'];?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="date">Date</label>  
                                <div class="col-md-7">
                                    <input id="date" name="date" type="text" value="<?php echo dateFormat($row['date']);?>" class="form-control input-md" readonly>
                                </div>
                            </div> 
                            
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="ok"></label>
                                <div class="col-md-7">
                                    <button id="ok" name="ok" class="btn btn-primary">OK</button>
                                </div>
                            </div>
                        </form>
                        <?php
                                }
                            }
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