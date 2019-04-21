<?php 
session_start();
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['id']) || $_GET['id'] == NULL){
    header("Location:index.php");
}else{
    $owner_id = $_GET['id'];
}
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';

?>
    <script type='text/javascript'>
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / Update Profile Details</span>
            <h2>Update Profile Details</h2>
        </div>
    </div>
    <!-- banner -->


    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    global $con;

                    $firstName  = validate($_POST['firstname']);
                    $lastName = validate($_POST['lastname']);
                    $email = validate($_POST['email']);
                    $phone = validate($_POST['phone']);
                    $address = validate($_POST['address']);
                    $zipcode = validate($_POST['zipcode']);
                    $nid_number = validate($_POST['nid_number']);

                    $firstName = mysqli_real_escape_string($con,$firstName);
                    $lastName = mysqli_real_escape_string($con,$lastName);
                    $email = mysqli_real_escape_string($con,$email);
                    $phone = mysqli_real_escape_string($con,$phone);
                    $address = mysqli_real_escape_string($con,$address);
                    $zipcode = mysqli_real_escape_string($con,$zipcode);
                    $nid_number = mysqli_real_escape_string($con,$nid_number);

                    /*******NID Image upload code********/
                    $permitted    = array('jpg','png','jpeg','gif');
                    $file_name    = $_FILES['nid_image']['name'];
                    $file_size    = $_FILES['nid_image']['size'];
                    $file_temp    = $_FILES['nid_image']['tmp_name'];

                    $div          = explode('.', $file_name);
                    $file_ext     = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_nid_image = "owners_upload/".$unique_image;


                    if(empty($firstName) || empty ($lastName) ||empty ($email) ||empty ($phone)||
                       empty($address)||empty ($zipcode)||empty ($nid_number))
                    {

                        $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                                </div>";
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Error!</strong> Invalid Email Address.
                                </div>";
                    } else {
                        if(!empty($file_name)){
                            if($file_size > 2048567){
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Image Size Must Be Less Then 2MB.
                                        </div>";
                            }elseif(in_array($file_ext, $permitted) === false){
                                 $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.".implode(', ',$permitted).
                                        "</div>";
                            }else{
                                move_uploaded_file($file_temp, $uploaded_nid_image);
                                $query = "UPDATE tbl_owner SET firstname='$firstName',lastname='$lastName',email='$email',phone='$phone',address='$address',zipcode='$zipcode',nid_number='$nid_number',nid_image='$uploaded_nid_image' WHERE owner_id='$owner_id'";
                                $updated_profile = mysqli_query($con, $query);
                                if ($updated_profile) {
                                    echo "<script>alert('Profile Updated Successfully!')</script>";
                                   
                                } else {
                                    echo "<script>alert('Profile Not Updated!')</script>";
                                }
                            }
                        }else{
                            $query = "UPDATE tbl_owner SET firstname='$firstName',lastname='$lastName',email='$email',phone='$phone',address='$address',zipcode='$zipcode',nid_number='$nid_number' WHERE owner_id='$owner_id'";
                            $updated_profile = mysqli_query($con, $query);
                            if ($updated_profile) {
                                echo "<script>alert('Profile Updated Successfully Without NID Image!')</script>";
                              
                            } else {
                                echo "<script>alert('Profile Not Updated!')</script>";
                            }
                        }
                    }

                }
                ?>
                <?php
                global $con;
                $select_query = "SELECT * FROM tbl_owner WHERE owner_id='$owner_id'";
                $result = mysqli_query($con, $select_query);
                if($result){
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <?php
                    if(isset($msg))
                    {
                        echo $msg;               
                    }
                    ?>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="fn">First name</label>  
                        <div class="col-md-9">
                           <input id="fn" name="firstname" type="text" class="form-control input-md" value="<?php echo $row['firstname'];?>">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="ln">Last name</label>  
                        <div class="col-md-9">
                            <input id="ln" name="lastname" type="text" class="form-control input-md" value="<?php echo $row['lastname'];?>" >
                        </div>
                    </div>               


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>  
                        <div class="col-md-9">
                            <input id="email" name="email" type="email" class="form-control input-md" value="<?php echo $row['email'];?>">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="phone">Phone No.</label>  
                        <div class="col-md-9">
                            <input id="phone" name="phone" type="tel" class="form-control input-md" value="<?php echo $row['phone'];?>">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="add1">Address</label>  
                        <div class="col-md-9">
                            <textarea name="address" class="form-control"><?php echo $row['address'];?></textarea>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="zip">Area Zip Code</label>  
                        <div class="col-md-9">
                            <input id="zip" name="zipcode" type="text" class="form-control input-md" value="<?php echo $row['zipcode'];?>">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nidnum">National Identity  Number(NID)</label>  
                        <div class="col-md-9">
                            <input id="nidnum" name="nid_number" type="number"  class="form-control input-md" value="<?php echo $row['nid_number'];?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nidimage">Update Your NID Photo</label>  
                        <div class="col-md-9">
                            <input id="nidimage" name="nid_image" type="file" accept="image/*" onchange="preview_image(event)"  class="form-control input-md" >                   
                        </div>               
                    </div>
                    <div  class="form-group">
                        <label class="col-md-3 control-label"></label> 
                        <div class="col-md-9" id="nid-photo">
                            <img src="<?php echo $row['nid_image'];?>" id="output_image"/>                     
                        </div>
                    </div> 

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-10 control-label" for="update"></label>
                        <div class="col-md-2">
                            <button id="update" name="update" class="btn btn-primary">UPDATE</button>
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

