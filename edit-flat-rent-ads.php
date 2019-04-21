<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['flat_rent_id']) || $_GET['flat_rent_id'] == NULL){
    header("Location:owner-account.php");
}else{    
    $flat_rent_id = $_GET['flat_rent_id'];
    $owner_id = $_SESSION['owner_id'];
}

include'include/header.php';

?>

    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / Update Flat Rent Details</span>
            <h2>Update Flat Rent Details</h2>
        </div>
    </div>
    <!-- banner -->
    
    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">
                <?php
                if(isset($_POST['update_flat_rent_ads'])){
                    global $con;
                        
                    $rent_building_name = validate($_POST['rent_building_name']);
                    $rent_building_name = mysqli_real_escape_string($con,$rent_building_name);

                    $rent_floor_num = validate($_POST['rent_floor_num']);
                    $rent_floor_num = mysqli_real_escape_string($con,$rent_floor_num);

                    $rent_flat_num = validate($_POST['rent_flat_num']);
                    $rent_flat_num = mysqli_real_escape_string($con,$rent_flat_num);

                    $total_bedroom = validate($_POST['total_bedroom']);
                    $total_bedroom = mysqli_real_escape_string($con,$total_bedroom);

                    $bedroom_size = validate($_POST['bedroom_size']);
                    $bedroom_size = mysqli_real_escape_string($con,$bedroom_size);

                    $total_livingroom = validate($_POST['total_livingroom']);
                    $total_livingroom = mysqli_real_escape_string($con,$total_livingroom);

                    $livingroom_size = validate($_POST['livingroom_size']);
                    $livingroom_size = mysqli_real_escape_string($con,$livingroom_size);

                    $total_bathroom = validate($_POST['total_bathroom']);
                    $total_bathroom = mysqli_real_escape_string($con,$total_bathroom);

                    $bathroom_size = validate($_POST['bathroom_size']);
                    $bathroom_size = mysqli_real_escape_string($con,$bathroom_size);

                    $total_kitchenroom = validate($_POST['total_kitchenroom']);
                    $total_kitchenroom = mysqli_real_escape_string($con,$total_kitchenroom);

                    $kitchenroom_size = validate($_POST['kitchenroom_size']);
                    $kitchenroom_size = mysqli_real_escape_string($con,$kitchenroom_size);

                    $rent_per_month = validate($_POST['rent_per_month']);
                    $rent_per_month = mysqli_real_escape_string($con,$rent_per_month);

                    $advance_payment = validate($_POST['advance_payment']);
                    $advance_payment = mysqli_real_escape_string($con,$advance_payment);

                    $area_name = validate($_POST['area_name']);
                    $area_name = mysqli_real_escape_string($con,$area_name);

                    $city = validate($_POST['city']);
                    $city = mysqli_real_escape_string($con,$city);
                    
                    $building_address = mysqli_real_escape_string($con,$_POST['building_address']);
                                               
                    $description = mysqli_real_escape_string($con,$_POST['description']);
                    
                    /*$property_type = validate($_POST['property_type']);
                    $property_type = mysqli_real_escape_string($con,$property_type);*/

                    $available = validate($_POST['available']);
                    $available = mysqli_real_escape_string($con,$available);

                    $permitted    = array('jpg','png','jpeg','gif');
                    $flat_image_name    = $_FILES['flat_image']['name'];
                    $flat_image_size    = $_FILES['flat_image']['size'];
                    $flat_image_temp    = $_FILES['flat_image']['tmp_name'];

                    $div_img          = explode('.', $flat_image_name);
                    $flat_image_ext     = strtolower(end($div_img));
                    $unique_flat_image = substr(md5(time()), 0, 10).'.'.$flat_image_ext;
                    $upload_flat_image = "owners_upload/rent-flat-photo/".$unique_flat_image;

                    if (empty($rent_building_name) || empty($rent_floor_num) || empty($rent_flat_num) || empty($total_bedroom) || empty($bedroom_size) ||
                        empty($total_livingroom) || empty($livingroom_size) || empty($total_bathroom) || empty($bathroom_size) ||
                        empty($total_kitchenroom) || empty($kitchenroom_size) || empty($rent_per_month) ||empty($advance_payment) || empty($area_name) || empty($city) || empty($building_address) || empty($description)||empty($available))
                    {
                        $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                                </div>";
                    }else{
                       if(!empty($flat_image_name)){
                            if($flat_image_size > 2048567){
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Image Size Must Be Less Then 2MB.
                                        </div>";
                            }elseif(in_array($flat_image_ext, $permitted) === false){
                                 $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.".implode(', ',$permitted).
                                        "</div>";
                            }else{
                                move_uploaded_file($flat_image_temp, $upload_flat_image);
                                $query = "UPDATE  tbl_flat_rent_ads SET rent_building_name='$rent_building_name', rent_floor_num='$rent_floor_num', rent_flat_num='$rent_flat_num', total_bedroom='$total_bedroom', bedroom_size='$bedroom_size', 
                                        total_livingroom='$total_livingroom', livingroom_size='$livingroom_size', total_bathroom='$total_bathroom', bathroom_size='$bathroom_size', total_kitchenroom='$total_kitchenroom', 
                                        kitchenroom_size='$kitchenroom_size', rent_per_month='$rent_per_month',advance_payment='$advance_payment', area_name='$area_name', city='$city', building_address='$building_address', description='$description', flat_image='$upload_flat_image',available='$available' WHERE id='$flat_rent_id' AND owner_id='$owner_id'";
                                $update_flat_rent_data = mysqli_query($con, $query);
                                if ($update_flat_rent_data) {
                                    echo "<script>alert('Flat Rent Data Updated Successfully!')</script>";
                                   
                                } else {
                                    echo "<script>alert('Flat Rent Data Not Updated!')</script>";
                                }
                            }
                       }else{
                           $query = "UPDATE  tbl_flat_rent_ads SET rent_building_name='$rent_building_name', rent_floor_num='$rent_floor_num', rent_flat_num='$rent_flat_num', total_bedroom='$total_bedroom', bedroom_size='$bedroom_size', 
                                        total_livingroom='$total_livingroom', livingroom_size='$livingroom_size', total_bathroom='$total_bathroom', bathroom_size='$bathroom_size', total_kitchenroom='$total_kitchenroom', 
                                        kitchenroom_size='$kitchenroom_size', rent_per_month='$rent_per_month',advance_payment='$advance_payment', area_name='$area_name', city='$city', building_address='$building_address', description='$description',available='$available' WHERE id='$flat_rent_id' AND owner_id='$owner_id'";
                            
                           $update_flat_rent_data = mysqli_query($con, $query);
                            if ($update_flat_rent_data) {
                                echo "<script>alert('Flat Rent Data Updated Successfully!')</script>";

                            } else {
                                echo "<script>alert('Flat Rent Data Not Updated!')</script>";
                            }
                       }
                   }
                }
                ?>
                
                <?php
                global $con;
                $select_query = "SELECT * FROM tbl_flat_rent_ads WHERE id='$flat_rent_id' AND owner_id='$owner_id'";
                $run_query = mysqli_query($con, $select_query);
                if($run_query){
                    while ($row = mysqli_fetch_array($run_query)) {
                ?>
                
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <?php
                    if(isset($msg))
                    {
                        echo $msg;               
                    }
                    ?>    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="rent_building_name">Building Name</label>  
                        <div class="col-md-9">
                            <input id="rent_building_name" name="rent_building_name" type="text" value="<?php echo $row['rent_building_name'];?>" class="form-control input-md" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                        <div class="col-md-9">
                            <input id="floor_num" name="rent_floor_num" type="number" value="<?php echo $row['rent_floor_num'];?>" class="form-control input-md" >
                        </div>
                    </div>               


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                        <div class="col-md-9">
                            <input id="flat_num" name="rent_flat_num" type="text" value="<?php echo $row['rent_flat_num'];?>" class="form-control input-md" >
                        </div>
                    </div>                      

                    <div class="form-group">
                        <label class="col-md-3 control-label">Available From</label>  
                        <div class="col-md-9">
                            <select name="available" class="form-control">
                                <option value="JANUARY"<?php if($row['available']=="JANUARY") echo 'selected="selected"'; ?>>January</option>
                                <option value="FEBRUARY"<?php if($row['available']=="FEBRUARY") echo 'selected="selected"'; ?>>February</option>
                                <option value="MARCH"<?php if($row['available']=="MARCH") echo 'selected="selected"'; ?>>March</option>
                                <option value="APRIL"<?php if($row['available']=="APRIL") echo 'selected="selected"'; ?>>April</option>
                                <option value="MAY"<?php if($row['available']=="MAY") echo 'selected="selected"'; ?>>May</option>
                                <option value="JUNE"<?php if($row['available']=="JUNE") echo 'selected="selected"'; ?>>June</option>
                                <option value="JULY"<?php if($row['available']=="JULY") echo 'selected="selected"'; ?>>July</option>
                                <option value="AUGUST"<?php if($row['available']=="AUGUST") echo 'selected="selected"'; ?>>August</option>
                                <option value="SEPTEMBER"<?php if($row['available']=="SEPTEMBER") echo 'selected="selected"'; ?>>September</option>
                                <option value="OCTOBER"<?php if($row['available']=="OCTOBER") echo 'selected="selected"'; ?>>October</option>
                                <option value="NOVEMBER"<?php if($row['available']=="NOVEMBER") echo 'selected="selected"'; ?>>November</option>
                                <option value="DECEMBER"<?php if($row['available']=="DECEMBER") echo 'selected="selected"'; ?>>December</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="total_bedroom">Total Bed Room</label>  
                        <div class="col-md-9">
                            <input id="total_bedroom" name="total_bedroom" value="<?php echo $row['total_bedroom'];?>" type="number" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="bedroom_size">Bed Room Size(sqrt ft.)</label>  
                        <div class="col-md-9">
                            <input id="bedroom_size" name="bedroom_size" type="text" value="<?php echo $row['bedroom_size'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="total_livingroom">Total Living Room</label>  
                        <div class="col-md-9">
                            <input id="total_livingroom" name="total_livingroom" type="number" value="<?php echo $row['total_livingroom'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="livingroom_size">Living Room Size(sqrt ft.)</label>  
                        <div class="col-md-9">
                            <input id="livingroom_size" name="livingroom_size" type="text" value="<?php echo $row['livingroom_size'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="total_bathroom">Total Bath Room</label>  
                        <div class="col-md-9">
                            <input id="total_bathroom" name="total_bathroom" type="number" value="<?php echo $row['total_bathroom'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="bathroom_size">Bath Room Size(sqrt ft.)</label>  
                        <div class="col-md-9">
                            <input id="bathroom_size" name="bathroom_size" type="text" value="<?php echo $row['bathroom_size'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="total_kitchenroom">Total Kitchen Room</label>  
                        <div class="col-md-9">
                            <input id="total_kitchenroom" name="total_kitchenroom" type="number" value="<?php echo $row['total_kitchenroom'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="kitchenroom_size">Kitchen Room Size(sqrt ft.)</label>  
                        <div class="col-md-9">
                            <input id="kitchenroom_size" name="kitchenroom_size" type="text" value="<?php echo $row['kitchenroom_size'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="rent_per_month">Rent Per Month(Tk)</label>  
                        <div class="col-md-9">
                            <input id="rent_per_month" name="rent_per_month" type="number" value="<?php echo $row['rent_per_month'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="advance_payment">Advance Payment(Tk)</label>  
                        <div class="col-md-9">
                            <input id="advance_payment" name="advance_payment" type="number" value="<?php echo $row['advance_payment'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="areaName">Area Name</label>  
                        <div class="col-md-9">
                            <input id="areaName" name="area_name" type="text" value="<?php echo $row['area_name'];?>" class="form-control input-md" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="city">city</label>  
                        <div class="col-md-9">
                            <input id="city" name="city" type="text" value="<?php echo $row['city'];?>" class="form-control input-md" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>  
                        <div class="col-md-9">
                            <textarea name="building_address" class="form-control" ><?php echo $row['building_address'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Description/Condition</label>  
                        <div class="col-md-9">
                            <textarea name="description" class="form-control tinymce" ><?php echo $row['description'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="flat_image">Upload Flat Photo</label>  
                        <div class="col-md-4">
                            <input id="flat_image" name="flat_image" type="file"   class="form-control input-md" >                   
                        </div>                   
                    </div>
                     <div  class="form-group">
                        <label class="col-md-3 control-label"></label> 
                        <div class="col-md-4" id="nid-photo">
                            <img src="<?php echo $row['flat_image'];?>" id="output_image"/>                     
                        </div>
                    </div> 
                                       

                    <div class="form-group">
                        <label class="col-md-10 control-label" for="submit"></label>
                        <div class="col-md-2">
                            <button type="submit" name="update_flat_rent_ads" class="btn btn-primary">UPDATE</button>            
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


