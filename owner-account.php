<?php 
session_start();
if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}


include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';?>
<!-- banner -->
<script>
  $(function () {
    $('#myTab a:last').tab('show')
  })
  
</script>
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
      <span class="pull-right"><a href="#">Home</a> / My Account</span>
      <h2>My Account</h2>
    </div>
</div>
<!-- banner -->

<section class="container-fluid">
    <div class="container" >
        
        <div class="row owner-account">
            
         
            
            <?php
            if(isset($_SESSION['email'])){
                global $con;
                $owner_id = $_SESSION['owner_id'];
                $email = $_SESSION['email'];
                $query = "SELECT * FROM tbl_owner WHERE owner_id='$owner_id' AND email='$email'";
                $result = mysqli_query($con, $query);
                if($result){
                    $row = mysqli_fetch_array($result);
                }
            }

            ?>
            <div class="panel">
                <?php
                if($row['profile_image']==true){
               ?>
                <img class="pic img-circle" src="<?php echo $row['profile_image'];?>" alt="...">
                <?php
                }else{
                ?>
                <img class="pic img-circle" src="images/images.png" alt="...">
                <?php    
                }
                ?>
                
                <div class="name"><small><?php echo $row['firstname']." ".$row['lastname'];?></small></div>               
            </div>
            <br><br><br>
            
            <!--tab header-->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#myinfo" data-toggle="tab"><i class="fa fa-info-circle"></i> My Info.</a></li>
                <li><a href="#profilePhoto" data-toggle="tab"><i class="fa fa-picture-o"></i> Upload Profile Photo</a></li>
                <li><a href="#updatePassword" data-toggle="tab"><i class="fa fa-key"></i> Update Password</a></li>
                <li><a href="#addFlatSellAds" data-toggle="tab"><i class="fa fa-file-text-o"></i> Add Flat Sell Ads</a></li>
                <li><a href="#flatSellAdsList" data-toggle="tab"><i class="fa fa-list-ol"></i> Flat Sell Ads List</a></li>
                <li><a href="#addFlatRentAds" data-toggle="tab"><i class="fa fa-file-text-o"></i> Add Flat Rent Ads</a></li>
                <li><a href="#flatRentAdsList" data-toggle="tab"><i class="fa fa-list-ol"></i> Flat Rent Ads List</a></li>
                
                <li>
                    <a href="#inbox" data-toggle="tab"><i class="fa fa-envelope"></i> 
                        Inbox 
                        <?php
                            global $con;
                            $owner_email = $_SESSION['email'];
                            $inbox_query = "SELECT * FROM customer_message WHERE status='0' AND owner_email='$owner_email' ORDER BY msg_id DESC";
                            $inbox_run_query  = mysqli_query($con, $inbox_query);
                            if($inbox_run_query){
                                $count = mysqli_num_rows($inbox_run_query);
                                echo "(".$count.")";
                            }else{
                                echo "(0)";
                            }
                        ?>
                    </a>
                </li>
                <li><a href="#addNewTenant" data-toggle="tab"><i class="fa fa-user"></i> Add New Tenant</a></li>
                <li><a href="#tenantList" data-toggle="tab"><i class="fa fa-list-ol"></i> Tenant List</a></li>
                <li><a href="#addNotice" data-toggle="tab"><i class="fa fa-flag"></i> Add Notice</a></li>
                <li><a href="#noticeList" data-toggle="tab"><i class="fa fa-list-ol"></i>My Notice List</a></li>
                <li>
                    <a href="#tenantNotice" data-toggle="tab"><i class="fa fa-bell"></i> Tenant Notice
                    <?php
                        global $con;
                        $owner_id = $_SESSION['owner_id'];
                        $notice_box_query = "SELECT * FROM tbl_tenant_notice WHERE status='0' AND owner_id='$owner_id'";
                        $notice_box  = mysqli_query($con, $notice_box_query);
                        if($notice_box){
                            $count = mysqli_num_rows($notice_box);
                            echo "(".$count.")";
                        }else{
                            echo "(0)";
                        }
                        ?>
                    </a>
                </li>
                <li><a href="#addRentAmountReceived" data-toggle="tab"><i class="fa fa-usd"></i> Add Rent Amount Received</a></li>
                <li><a href="#rentAmountDetails" data-toggle="tab"><i class="fa fa-usd"></i> My Rent Amount Details</a></li>  
                <li><a href="#sendPersonalNotice" data-toggle="tab"><i class="fa fa-flag"></i> Send Personal Notice</a></li>
                <li><a href="#personalNoticeList" data-toggle="tab"><i class="fa fa-list-ol"></i> Personal Notice List</a></li> 
                <li><a href="#rentReceivedConfirm" data-toggle="tab"><i class="fa fa-list-ol"></i> Rent Paid By Tenant Confirmation</a></li>
                
            </ul>
            
            <!--tab body-->
            <div class="tab-content">
                <!--Owner Account Information-->
                <div class="tab-pane active" id="myinfo">                  
                    <form class="form-horizontal">
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="fn">First name</label>  
                            <div class="col-md-9">
                                <input id="fn" name="firstname" type="text" class="form-control input-md" value="<?php echo $row['firstname'];?>" readonly>
                            </div>
                        </div>

                      
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="ln">Last name</label>  
                            <div class="col-md-9">
                                <input id="ln" name="lastname" type="text" class="form-control input-md" value="<?php echo $row['lastname'];?>" readonly>
                            </div>
                        </div>               


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">Email</label>  
                            <div class="col-md-9">
                                <input id="email" name="email" type="email" class="form-control input-md" value="<?php echo $row['email'];?>" readonly>
                            </div>
                        </div>                      

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="phone">Phone No.</label>  
                            <div class="col-md-9">
                                <input id="phone" name="phone" type="tel" class="form-control input-md" value="<?php echo $row['phone'];?>" readonly>
                            </div>
                        </div>

                     
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="add1">Address</label>  
                            <div class="col-md-9">
                                <textarea name="address" class="form-control" readonly><?php echo $row['address'];?></textarea>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="zip">Area Zip Code</label>  
                            <div class="col-md-9">
                                <input id="zip" name="zipcode" type="text" class="form-control input-md" value="<?php echo $row['zipcode'];?>" readonly>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="nidnum">National Identity  Number(NID)</label>  
                            <div class="col-md-9">
                                <input id="nidnum" name="nid_number" type="number"  class="form-control input-md" value="<?php echo $row['nid_number'];?>" readonly>
                            </div>
                        </div>


                        
                        <div  class="form-group">
                            <label class="col-md-3 control-label">Your NID Photo</label> 
                            <div class="col-md-9" id="nid-photo">
                                <img src="<?php echo $row['nid_image'];?>"/>                     
                            </div>
                        </div> 

                      
                        <div class="form-group">
                            <label class="col-md-10 control-label" for="submit"></label>
                            <div class="col-md-2">
                                <a href="edit-profile.php?id=<?php echo $row['owner_id'];?>">
                                    <button type="button" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span> Edit Profile
                                    </button>
                                </a>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </form>
                </div>
                <!--/Owner Account Information-->
                
                <!--Upload Profile Photo-->
                <div class="tab-pane" id="profilePhoto">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php                            
                            if(isset($_POST['upload_profile_photo'])){
                                global $con;
                                
                                $owner_id = $_SESSION['owner_id'];
                                $email = $_SESSION['email']; 
                                
                                $permitted    = array('jpg','png','jpeg','gif');
                                $profile_image_name    = $_FILES['profile_image']['name'];
                                $profile_image_size    = $_FILES['profile_image']['size'];
                                $profile_image_temp    = $_FILES['profile_image']['tmp_name'];

                                $division          = explode('.', $profile_image_name);
                                $profile_image_ext     = strtolower(end($division));
                                $unique_profile_image = substr(md5(time()), 0, 10).'.'.$profile_image_ext;
                                $upload_profile_image = "owners_upload/profile-photo/".$unique_profile_image;
                                
                                if(empty ($profile_image_name))
                                {

                                    $msg = "<div class='alert alert-danger'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Warning!</strong>Image Input Field Must Not Be Empty.
                                            </div>";
                                }elseif($profile_image_size > 1048576){
                                     echo "<script>alert('Image Size Is Large!')</script>";
                                }elseif(in_array($profile_image_ext, $permitted) === false){
                                    $msg = "<div class='alert alert-danger'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Warning!</strong> Input Field Must Not Be Empty.".implode(', ',$permitted).
                                            "</div>";
                                }else{
                                    move_uploaded_file($profile_image_temp, $upload_profile_image);
                                    $upload_query = "UPDATE tbl_owner SET profile_image='$upload_profile_image' WHERE owner_id='$owner_id' AND email='$email'";
                                    $result = mysqli_query($con, $upload_query);
                                    if($result){
                                        echo "<script>alert('Image Uploaded Successful!')</script>";
                                        echo "<script>window.open('owner-account.php','_self')</script>";
                                    }else{
                                        echo "<script>alert('Image Not Uploaded!')</script>";
                                    }
                                }
                            }
                        
                        ?>
                        
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <?php
                            if(isset($msg))
                            {
                                echo $msg;               
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="profileImage">Upload Your Profile Photo</label>  
                                <div class="col-md-4">
                                    <input id="profileImage" name="profile_image" type="file" accept="image/*" onchange="preview_image(event)"  class="form-control input-md" >                   
                                </div>
                                
                            </div>
                            <div  class="form-group">
                                <label class="col-md-3 control-label"></label> 
                                <div class="col-md-4" id="nid-photo">
                                    <img src="" id="output_image"/>                     
                                </div>
                            </div>
                            <div  class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-3">
                                    <button type="submit" name="upload_profile_photo" class="btn btn-primary">Upload Profile Photo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/Upload Profile Photo-->
                
                 <!--Update Password-->
                <div class="tab-pane" id="updatePassword">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['update_password'])){
                            global $con;
                                
                            $owner_id = $_SESSION['owner_id'];
                            $email = $_SESSION['email']; 
                        
                            $old_password = validate(md5($_POST['old_password']));
                            $old_password = mysqli_real_escape_string($con,$old_password);
                            
                            $new_password = validate(md5($_POST['new_password']));
                            $new_password = mysqli_real_escape_string($con,$new_password);
                            
                            $cf_password = validate(md5($_POST['cf_password']));
                            $cf_password = mysqli_real_escape_string($con,$cf_password);
                            
                            $match_old_pw_query = "SELECT * FROM tbl_owner WHERE owner_id='$owner_id' AND email='$email'";
                            $match_old_pw = mysqli_query($con, $match_old_pw_query);
                            
                            if($match_old_pw){
                                $match_old_pw_row = mysqli_fetch_array($match_old_pw);
                            }
                            
                            
                            if (empty ($old_password)||empty ($new_password)||empty ($cf_password)) {
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }elseif ($old_password !== $match_old_pw_row['password']) {
                                echo "<script>alert('Your Old Password Not Matched! Try Again.')</script>";
                            } elseif ($new_password !== $cf_password) {
                                echo "<script>alert('New Password And Confirm Password Not Matched!')</script>";
                            }else{
                                $update_password_query = "UPDATE tbl_owner SET password='$cf_password' WHERE owner_id='$owner_id' AND email='$email'";
                                $update_password = mysqli_query($con, $update_password_query);
                                if($update_password){
                                    echo "<script>alert('Password Updated Successfully!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                } else {
                                    echo "<script>alert('Password Not Updated!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="oldpassword">Old Password</label>  
                                <div class="col-md-4">
                                    <input id="oldpassword" name="old_password" type="password"  class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="newpassword">New Password</label>  
                                <div class="col-md-4">
                                    <input id="newpassword" name="new_password" type="password"  class="form-control input-md" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="cfpassword">Confirm Password</label>  
                                <div class="col-md-4">
                                    <input id="cfpassword" name="cf_password" type="password" class="form-control input-md" >
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="submit"></label>
                                <div class="col-md-4">
                                    <button id="submit" name="update_password" class="btn btn-primary">UPDATE PASSWORD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/Update Password-->
                
                <!--Add Flat Sell Ads-->
                <div class="tab-pane" id="addFlatSellAds">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['submit_flat_sell_ads'])){
                            global $con;
                            
                            $owner_id = $_SESSION['owner_id'];
                            
                            $building_name = validate($_POST['building_name']);
                            $building_name = mysqli_real_escape_string($con,$building_name);
                            
                            $floor_num = validate($_POST['floor_num']);
                            $floor_num = mysqli_real_escape_string($con,$floor_num);
                            
                            $flat_num = validate($_POST['flat_num']);
                            $flat_num = mysqli_real_escape_string($con,$flat_num);
                            
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
                            
                            $price = validate($_POST['price']);
                            $price = mysqli_real_escape_string($con,$price);
                            
                            $area_name = validate($_POST['area_name']);
                            $area_name = mysqli_real_escape_string($con,$area_name);
                            
                            $city = validate($_POST['city']);
                            $city = mysqli_real_escape_string($con,$city);
                            
                            $country = validate($_POST['country']);
                            $country = mysqli_real_escape_string($con,$country);
                            
                            $address = mysqli_real_escape_string($con,$_POST['address']);
                            
                            $description = mysqli_real_escape_string($con,$_POST['description']);
                            
                            $property_for = validate($_POST['property_for']);
                            $property_for = mysqli_real_escape_string($con,$property_for);
                            
                            $permitted    = array('jpg','png','jpeg','gif');
                            $flat_image_name    = $_FILES['flat_image']['name'];
                            $flat_image_size    = $_FILES['flat_image']['size'];
                            $flat_image_temp    = $_FILES['flat_image']['tmp_name'];

                            $div_img          = explode('.', $flat_image_name);
                            $flat_image_ext     = strtolower(end($div_img));
                            $unique_flat_image = substr(md5(time()), 0, 10).'.'.$flat_image_ext;
                            $upload_flat_image = "owners_upload/selling-flat-photo/".$unique_flat_image;
                            
                            if (empty($building_name) || empty($floor_num) || empty($flat_num) || empty($total_bedroom) || empty($bedroom_size) ||
                                empty($total_livingroom) || empty($livingroom_size) || empty($total_bathroom) || empty($bathroom_size) ||
                                empty($total_kitchenroom) || empty($kitchenroom_size) || empty($price) || empty($area_name) || empty($city) || empty($country) || empty($address) || empty($description) ||
                                empty($flat_image_name) || empty($property_for))
                            {
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.
                                        </div>";
                            }elseif($flat_image_size > 2048567){
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
                               $query = "INSERT INTO  tbl_flat_sell_ads(owner_id, building_name, floor_num, flat_num, total_bedroom, bedroom_size, total_livingroom, livingroom_size, total_bathroom, bathroom_size, total_kitchenroom, kitchenroom_size, price, area_name, city, country, building_address, description, flat_image,property_for) 
                                         VALUES('$owner_id','$building_name','$floor_num','$flat_num','$total_bedroom','$bedroom_size','$total_livingroom','$livingroom_size','$total_bathroom','$bathroom_size','$total_kitchenroom','$kitchenroom_size','$price','$area_name','$city','$country','$address','$description','$upload_flat_image','$property_for')";
                               $insert_data = mysqli_query($con, $query);
                               if($insert_data){
                                   echo "<script>alert('After Receiving The Payment We Will Approve The Ads!')</script>";
                                   
                                } else {
                                    echo "<script>alert('Flat Sell Ads Data Not Inserted !')</script>";
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
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Building Name</label>  
                                <div class="col-md-9">
                                    <input id="buildingName" name="building_name" type="text" class="form-control input-md" >
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-9">
                                    <input id="floor_num" name="floor_num" type="number" class="form-control input-md" >
                                </div>
                            </div>               


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-9">
                                    <input id="flat_num" name="flat_num" type="text" class="form-control input-md" >
                                </div>
                            </div>                      


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bedroom">Total Bed Room</label>  
                                <div class="col-md-9">
                                    <input id="total_bedroom" name="total_bedroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bedroom_size">Bed Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="bedroom_size" name="bedroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_livingroom">Total Living Room</label>  
                                <div class="col-md-9">
                                    <input id="total_livingroom" name="total_livingroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="livingroom_size">Living Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="livingroom_size" name="livingroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bathroom">Total Bath Room</label>  
                                <div class="col-md-9">
                                    <input id="total_bathroom" name="total_bathroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bathroom_size">Bath Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="bathroom_size" name="bathroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_kitchenroom">Total Kitchen Room</label>  
                                <div class="col-md-9">
                                    <input id="total_kitchenroom" name="total_kitchenroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kitchenroom_size">Kitchen Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="kitchenroom_size" name="kitchenroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="price">Price(Tk)</label>  
                                <div class="col-md-9">
                                    <input id="price" name="price" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="areaName">Area Name</label>  
                                <div class="col-md-9">
                                    <input id="areaName" name="area_name" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="city">City</label>  
                                <div class="col-md-9">
                                    <input id="city" name="city" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <div class="col-md-9">
                                    <input name="country" type="hidden" value="Bangladesh" class="form-control input-md" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>  
                                <div class="col-md-9">
                                    <textarea name="address" class="form-control" ></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>  
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control tinymce" ></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_image">Upload Flat Photo</label>  
                                <div class="col-md-4">
                                    <input id="flat_image" name="flat_image" type="file"   class="form-control input-md" >                   
                                </div>                   
                            </div>
                            
                            <input id="property_for" name="property_for" type="hidden" value="<?php echo 'sale';?>" class="form-control input-md" >
                            <div class="form-group">
                                <label class="col-md-10 control-label" for="submit"></label>
                                <div class="col-md-2">
                                    <button type="submit" name="submit_flat_sell_ads" class="btn btn-primary">SUBMIT</button>            
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/Add Flat Sell Ads-->
                
                <!--Flat Sell Ads List-->
                <div class="tab-pane" id="flatSellAdsList">
                    <div class="col-md-12 col-lg-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_GET['flat_sold_id'])){
                            global $con;
                            $owner_id = $_SESSION['owner_id'];
                            $flat_sold_id = mysqli_real_escape_string($con,$_GET['flat_sold_id']);
                            $update_sold_flat_query = "UPDATE tbl_flat_sell_ads SET sold='1' WHERE owner_id='$owner_id' AND id='$flat_sold_id'";
                            $update_sold_flat = mysqli_query($con, $update_sold_flat_query);
                            if($update_sold_flat){
                                echo "<script>alert('This Apartment Added To Sold List')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";
                            }else{
                                echo "<script>alert('This Apartment Is Not Added To Sold List')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";
                            }
                        }
                        ?>    
                        <div class="col-md-12 col-lg-12" style="overflow: scroll;">
                        <table id="example" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Flat Image</th>
                                    <th>Total Bedroom</th>
                                    <th>Bedroom Sz(Sq. ft.)</th>
                                    <th>Total Living Rm</th>
                                    <th>Living Rm Sz(Sq. ft.)</th>
                                    <th>Total Bathroom</th>
                                    <th>Bathroom Sz(Sq. ft.)</th>
                                    <th>Total Kitchen Rm</th>
                                    <th>Kitcehn Rm Sz(Sq. ft.)</th>
                                    <th>Price(Tk)</th>
                                    <th>Building Add.</th>
                                    <th>Description</th>                                   
                                    <th>Date</th>
                                    <th>Action</th>                                   
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $flat_sell_list_query = "SELECT * FROM tbl_flat_sell_ads WHERE owner_id='$owner_id' AND sold='0' ORDER BY id DESC";
                                $flat_sell_run_query  = mysqli_query($con, $flat_sell_list_query);
                                if($flat_sell_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($flat_sell_run_query);
                                    if($count>0){
                                        while ($fsl_row = mysqli_fetch_array($flat_sell_run_query)) {
                                ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $fsl_row['building_name'];?></td>
                                                <td><?php echo $fsl_row['floor_num'];?></td>
                                                <td><?php echo $fsl_row['flat_num'];?></td>
                                                <td><img src="<?php echo $fsl_row['flat_image'];?>" alt="flat sell ads image" style="width:80px;height: 80px;"/></td>
                                                <td><?php echo $fsl_row['total_bedroom'];?></td>
                                                <td><?php echo $fsl_row['bedroom_size'];?></td>
                                                <td><?php echo $fsl_row['total_livingroom'];?></td>
                                                <td><?php echo $fsl_row['livingroom_size'];?></td>
                                                <td><?php echo $fsl_row['total_bathroom'];?></td>
                                                <td><?php echo $fsl_row['bathroom_size'];?></td>
                                                <td><?php echo $fsl_row['total_kitchenroom'];?></td>
                                                <td><?php echo $fsl_row['kitchenroom_size'];?></td>
                                                <td><?php echo number_format($fsl_row['price'],2);?></td>
                                                <td><?php echo $fsl_row['building_address'];?></td>
                                                <td><?php echo readMore($fsl_row['description'],100);?></td>
                                                <td><?php echo dateFormat($fsl_row['date']);?></td>

                                                <td>
                                                    <a href="?flat_sold_id=<?php echo $fsl_row['id'];?>" data-placement="top" data-toggle="tooltip" title="Sold"><button class="btn btn-default btn-xs" data-title="Sold" data-toggle="modal" data-target="#edit" style="background: #3c763d;border-color: #3c763e;color: white;"><span class="glyphicon glyphicon-check"></span></button></a>
                                                    
                                                    <a href="edit-flat-sell-ads.php?flat_sell_id=<?php echo $fsl_row['id'];?>" data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-default btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" style="background: #337ab7;border-color: #2e6da4;color: white;"><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                                                                                                                          
                                                    <a href="delete-flat-sell-ads.php?flat_sell_id=<?php echo $fsl_row['id'];?>" onclick="return confirm('Are you sure to delete this ads?');" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                               
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='20'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                        
                        
                        <div class="col-md-12" style="overflow: scroll;">
                            <h3 style="background: #72b70f;padding: 10px;color: white;font-weight: bold;margin-top: 70px;">Apartment Sold</h3>
                        <table class="display table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Flat Image</th>
                                    <th>Total Bedroom</th>
                                    <th>Bedroom Sz(Sq. ft.)</th>
                                    <th>Total Living Rm</th>
                                    <th>Living Rm Sz(Sq. ft.)</th>
                                    <th>Total Bathroom</th>
                                    <th>Bathroom Sz(Sq. ft.)</th>
                                    <th>Total Kitchen Rm</th>
                                    <th>Kitcehn Rm Sz(Sq. ft.)</th>
                                    <th>Price(Tk)</th>
                                    <th>Building Add.</th>
                                    <th>Description</th>                                   
                                    <th>Date</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $flat_sold_list_query = "SELECT * FROM tbl_flat_sell_ads WHERE owner_id='$owner_id' AND sold='1' ORDER BY id DESC";
                                $flat_sold_run_query  = mysqli_query($con, $flat_sold_list_query);
                                if($flat_sold_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($flat_sold_run_query);
                                    if($count>0){
                                        while ($sl_row = mysqli_fetch_array($flat_sold_run_query)) {
                                ?>
                                            <tr>
                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $sl_row['building_name'];?></td>
                                                <td><?php echo $sl_row['floor_num'];?></td>
                                                <td><?php echo $sl_row['flat_num'];?></td>
                                                <td><img src="<?php echo $sl_row['flat_image'];?>" alt="flat sell ads image" style="width:80px;height: 80px;"/></td>
                                                <td><?php echo $sl_row['total_bedroom'];?></td>
                                                <td><?php echo $sl_row['bedroom_size'];?></td>
                                                <td><?php echo $sl_row['total_livingroom'];?></td>
                                                <td><?php echo $sl_row['livingroom_size'];?></td>
                                                <td><?php echo $sl_row['total_bathroom'];?></td>
                                                <td><?php echo $sl_row['bathroom_size'];?></td>
                                                <td><?php echo $sl_row['total_kitchenroom'];?></td>
                                                <td><?php echo $sl_row['kitchenroom_size'];?></td>
                                                <td><?php echo number_format($sl_row['price'],2);?></td>
                                                <td><?php echo $sl_row['building_address'];?></td>
                                                <td><?php echo readMore($sl_row['description'],100);?></td>
                                                <td><?php echo dateFormat($sl_row['date']);?></td>

                                                <td>                                                                                    
                                                    <a href="delete-flat-sell-ads.php?flat_sell_id=<?php echo $sl_row['id'];?>" onclick="return confirm('Are you sure to delete this ads?');" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                               
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='20'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>    
                    </div>
                </div>
                <!--/Flat Sell Ads List-->
                
                <!--Add Flat Rent Ads-->
                <div class="tab-pane" id="addFlatRentAds">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['submit_flat_rent_ads'])){
                            global $con;
                            
                            $owner_id = $_SESSION['owner_id'];
                            
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
                            
                            $country = validate($_POST['country']);
                            $country = mysqli_real_escape_string($con,$country);

                            $building_address = mysqli_real_escape_string($con,$_POST['building_address']);
                            
                            $description = mysqli_real_escape_string($con,$_POST['description']);
                            
                            /*$property_type = validate($_POST['property_type']);
                            $property_type = mysqli_real_escape_string($con,$property_type);*/
                            
                            $available = validate($_POST['available']);
                            $available = mysqli_real_escape_string($con,$available);
                            
                            $property_for = validate($_POST['property_for']);
                            $property_for = mysqli_real_escape_string($con,$property_for);
                            
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
                                empty($total_kitchenroom) || empty($kitchenroom_size) || empty($rent_per_month) || empty($advance_payment) || empty($area_name) || empty($city) || empty($country) || empty($building_address) || empty($description) ||
                                empty($flat_image_name) ||empty($available) ||empty($property_for))
                            {
                                $msg = "<div class='alert alert-danger'>
                                            <button class='close' data-dismiss='alert'>&times;</button>
                                            <strong>Warning!</strong> Input Field Must Not Be Empty.
                                        </div>";
                            }elseif($flat_image_size > 2048567){
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
                               $query = "INSERT INTO  tbl_flat_rent_ads(owner_id, rent_building_name, rent_floor_num, rent_flat_num, total_bedroom, bedroom_size, total_livingroom, livingroom_size, total_bathroom, bathroom_size, total_kitchenroom, kitchenroom_size, rent_per_month, advance_payment, area_name, city, country, building_address, description, flat_image,property_for,available) 
                                         VALUES('$owner_id','$rent_building_name','$rent_floor_num','$rent_flat_num','$total_bedroom','$bedroom_size','$total_livingroom','$livingroom_size','$total_bathroom','$bathroom_size','$total_kitchenroom','$kitchenroom_size','$rent_per_month','$advance_payment','$area_name','$city','$country','$building_address','$description','$upload_flat_image','$property_for','$available')";
                               $insert_data = mysqli_query($con, $query);
                               if($insert_data){
                                   echo "<script>alert('After Receiving The Payment We Will Approve The Ads!')</script>";
                                   
                                } else {
                                    echo "<script>alert('Flat Rent Ads Data Not Inserted !')</script>";
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
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="rent_building_name">Building Name</label>  
                                <div class="col-md-9">
                                    <input id="rent_building_name" name="rent_building_name" type="text" class="form-control input-md" >
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-9">
                                    <input id="floor_num" name="rent_floor_num" type="number" class="form-control input-md" >
                                </div>
                            </div>               


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-9">
                                    <input id="flat_num" name="rent_flat_num" type="text" class="form-control input-md" >
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Available From</label>  
                                <div class="col-md-9">
                                    <select name="available" class="form-control">
                                        <option>Please Select Month</option>
                                        <option value="JANUARY">January</option>
                                        <option value="FEBRUARY">February</option>
                                        <option value="MARCH">March</option>
                                        <option value="APRIL">April</option>
                                        <option value="MAY">May</option>
                                        <option value="JUNE">June</option>
                                        <option value="JULY">July</option>
                                        <option value="AUGUST">August</option>
                                        <option value="SEPTEMBER">September</option>
                                        <option value="OCTOBER">October</option>
                                        <option value="NOVEMBER">November</option>
                                        <option value="DECEMBER">December</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bedroom">Total Bed Room</label>  
                                <div class="col-md-9">
                                    <input id="total_bedroom" name="total_bedroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bedroom_size">Bed Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="bedroom_size" name="bedroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_livingroom">Total Living Room</label>  
                                <div class="col-md-9">
                                    <input id="total_livingroom" name="total_livingroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="livingroom_size">Living Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="livingroom_size" name="livingroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bathroom">Total Bath Room</label>  
                                <div class="col-md-9">
                                    <input id="total_bathroom" name="total_bathroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bathroom_size">Bath Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="bathroom_size" name="bathroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_kitchenroom">Total Kitchen Room</label>  
                                <div class="col-md-9">
                                    <input id="total_kitchenroom" name="total_kitchenroom" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kitchenroom_size">Kitchen Room Size(sqrt ft.)</label>  
                                <div class="col-md-9">
                                    <input id="kitchenroom_size" name="kitchenroom_size" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="rent_per_month">Rent Per Month(Tk)</label>  
                                <div class="col-md-9">
                                    <input id="rent_per_month" name="rent_per_month" type="number" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="advance_payment">Advance Payment(Tk)</label>  
                                <div class="col-md-9">
                                    <input id="advance_payment" name="advance_payment" type="number" class="form-control input-md" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="areaName">Area Name</label>  
                                <div class="col-md-9">
                                    <input id="areaName" name="area_name" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="city">City</label>  
                                <div class="col-md-9">
                                    <input id="city" name="city" type="text" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <div class="col-md-9">
                                    <input name="country" type="hidden" value="Bangladesh" class="form-control input-md" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>  
                                <div class="col-md-9">
                                    <textarea name="building_address" class="form-control" ></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description/Condition</label>  
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control tinymce" ></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_image">Upload Flat Photo</label>  
                                <div class="col-md-4">
                                    <input id="flat_image" name="flat_image" type="file"   class="form-control input-md" >                   
                                </div>                   
                            </div>
                            
                            
                            <input id="property_for" name="property_for" type="hidden" value="<?php echo 'rent';?>" class="form-control input-md" >
                            <div class="form-group">
                                <label class="col-md-10 control-label" for="submit"></label>
                                <div class="col-md-2">
                                    <button type="submit" name="submit_flat_rent_ads" class="btn btn-primary">SUBMIT</button>            
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/Add Flat Rent Ads-->
                
                <!--Flat Rent Ads List-->
                <div class="tab-pane" id="flatRentAdsList">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_GET['flat_booked_id'])){
                            global $con;
                            $owner_id = $_SESSION['owner_id'];
                            $flat_booked_id = mysqli_real_escape_string($con,$_GET['flat_booked_id']);
                            $update_flat_booked_query = "UPDATE tbl_flat_rent_ads SET booked='1' WHERE owner_id='$owner_id' AND id='$flat_booked_id'";
                            $update_flat_booked = mysqli_query($con, $update_flat_booked_query);
                            if($update_flat_booked){
                                echo "<script>alert('This Apartment Added To Booked List')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";
                            }else{
                                echo "<script>alert('This Apartment Is Not Added To Booked List')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";
                            }
                        }
                        ?>
                        <div class="col-md-12 col-lg-12" style="overflow: scroll;">
                        <table id="example1" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Flat Image</th>
                                    <th>Monthly Rent(Tk)</th>
                                    <th>Advance Payment(Tk)</th>
                                    <th>Available From</th>
                                    <th>Total Bedroom</th>
                                    <th>Bedroom Sz(Sq. ft.)</th>
                                    <th>Total Living Rm</th>
                                    <th>Living Rm Sz(Sq. ft.)</th>
                                    <th>Total Bathroom</th>
                                    <th>Bathroom Sz(Sq. ft.)</th>
                                    <th>Total Kitchen Rm</th>
                                    <th>Kitcehn Rm Sz(Sq. ft.)</th>                                    
                                    <th>Building Add.</th>
                                    <th>Description</th>                                   
                                    <th>Date</th>
                                    <th>Action</th>                                   
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $flat_rent_list_query = "SELECT * FROM tbl_flat_rent_ads WHERE owner_id='$owner_id' AND booked='0' ORDER BY id DESC";
                                $flat_rent_run_query  = mysqli_query($con, $flat_rent_list_query);
                                if($flat_rent_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($flat_rent_run_query);
                                    if($count>0){
                                        while ($frl_row = mysqli_fetch_array($flat_rent_run_query)) {
                                ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $frl_row['rent_building_name'];?></td>
                                                <td><?php echo $frl_row['rent_floor_num'];?></td>
                                                <td><?php echo $frl_row['rent_flat_num'];?></td>
                                                <td><img src="<?php echo $frl_row['flat_image'];?>" alt="flat rent ads image" style="width:80px;height: 80px;"/></td>
                                                <td><?php echo number_format($frl_row['rent_per_month'],2);?></td>
                                                <td><?php echo number_format($frl_row['advance_payment'],2);?></td>                  
                                                <td><?php echo $frl_row['available'];?></td>
                                                <td><?php echo $frl_row['total_bedroom'];?></td>
                                                <td><?php echo $frl_row['bedroom_size'];?></td>
                                                <td><?php echo $frl_row['total_livingroom'];?></td>
                                                <td><?php echo $frl_row['livingroom_size'];?></td>
                                                <td><?php echo $frl_row['total_bathroom'];?></td>
                                                <td><?php echo $frl_row['bathroom_size'];?></td>
                                                <td><?php echo $frl_row['total_kitchenroom'];?></td>
                                                <td><?php echo $frl_row['kitchenroom_size'];?></td>
                                                <td><?php echo $frl_row['building_address'];?></td>
                                                <td><?php echo readMore($frl_row['description'],100);?></td>
                                                <td><?php echo dateFormat($frl_row['date']);?></td>

                                                <td>
                                                    <a href="?flat_booked_id=<?php echo $frl_row['id'];?>"  data-placement="top" data-toggle="tooltip" title="Booked"><button class="btn btn-default btn-xs" data-title="Booked" data-toggle="modal" data-target="#delete" style="background: #3c763d;border-color: #3c763e;color: white;"><span class="glyphicon glyphicon-check"></span></button></a>
                                                                                                        
                                                    <a href="edit-flat-rent-ads.php?flat_rent_id=<?php echo $frl_row['id'];?>" data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-default btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" style="background: #337ab7;border-color: #2e6da4;color: white;"><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                    
                                                    <a href="delete-flat-rent-ads.php?flat_rent_id=<?php echo $frl_row['id'];?>" onclick="return confirm('Are you sure to delete this ads?');" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='20'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                        
                        <div class="col-md-12" style="overflow: scroll;">
                        <h3 style="background: #72b70f;padding: 10px;color: white;font-weight: bold;margin-top: 70px;">Apartment Booked</h3>
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Flat Image</th>
                                    <th>Monthly Rent(Tk)</th>
                                    <th>Advance Payment(Tk)</th>
                                    <th>Available From</th>
                                    <th>Total Bedroom</th>
                                    <th>Bedroom Sz(Sq. ft.)</th>
                                    <th>Total Living Rm</th>
                                    <th>Living Rm Sz(Sq. ft.)</th>
                                    <th>Total Bathroom</th>
                                    <th>Bathroom Sz(Sq. ft.)</th>
                                    <th>Total Kitchen Rm</th>
                                    <th>Kitcehn Rm Sz(Sq. ft.)</th>                                    
                                    <th>Building Add.</th>
                                    <th>Description</th>                                   
                                    <th>Date</th>
                                    <th>Action</th>                                   
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $flat_rent_list_query = "SELECT * FROM tbl_flat_rent_ads WHERE owner_id='$owner_id' AND booked='1' ORDER BY id DESC";
                                $flat_rent_run_query  = mysqli_query($con, $flat_rent_list_query);
                                if($flat_rent_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($flat_rent_run_query);
                                    if($count>0){
                                        while ($frl_row = mysqli_fetch_array($flat_rent_run_query)) {
                                ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $frl_row['rent_building_name'];?></td>
                                                <td><?php echo $frl_row['rent_floor_num'];?></td>
                                                <td><?php echo $frl_row['rent_flat_num'];?></td>
                                                <td><img src="<?php echo $frl_row['flat_image'];?>" alt="flat rent ads image" style="width:80px;height: 80px;"/></td>
                                                <td><?php echo number_format($frl_row['rent_per_month'],2);?></td>
                                                <td><?php echo number_format($frl_row['advance_payment'],2);?></td>                  
                                                <td><?php echo $frl_row['available'];?></td>
                                                <td><?php echo $frl_row['total_bedroom'];?></td>
                                                <td><?php echo $frl_row['bedroom_size'];?></td>
                                                <td><?php echo $frl_row['total_livingroom'];?></td>
                                                <td><?php echo $frl_row['livingroom_size'];?></td>
                                                <td><?php echo $frl_row['total_bathroom'];?></td>
                                                <td><?php echo $frl_row['bathroom_size'];?></td>
                                                <td><?php echo $frl_row['total_kitchenroom'];?></td>
                                                <td><?php echo $frl_row['kitchenroom_size'];?></td>
                                                <td><?php echo $frl_row['building_address'];?></td>
                                                <td><?php echo readMore($frl_row['description'],100);?></td>
                                                <td><?php echo dateFormat($frl_row['date']);?></td>

                                                <td>
                                                    
                                                    <a href="delete-flat-rent-ads.php?flat_rent_id=<?php echo $frl_row['id'];?>" onclick="return confirm('Are you sure to delete this ads?');" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='20'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>    
                    </div>
                </div>
                <!--/Flat Rent Ads List-->
                
                <!--Inbox-->
                <div class="tab-pane" id="inbox">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">                        
                        
                        <table id="example2" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Message</th>                                   
                                    <th>Date</th>
                                    <th>Action</th>                                   
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_email = $_SESSION['email'];
                                $inbox_query = "SELECT * FROM customer_message WHERE status='0' AND owner_email='$owner_email' ORDER BY msg_id DESC";
                                $inbox_run_query  = mysqli_query($con, $inbox_query);
                                if($inbox_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($inbox_run_query);
                                    if($count>0){
                                         while ($inbx_row = mysqli_fetch_array($inbox_run_query)) {
                                ?>
                        
                                            <tr>
                                                <td></td>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $inbx_row['customer_name'];?></td>
                                                <td><?php echo $inbx_row['customer_email'];?></td>
                                                <td><?php echo $inbx_row['customer_phone_num'];?></td>
                                                <td><?php echo readMore($inbx_row['customer_message'],100);?></td>
                                                <td><?php echo dateFormat($inbx_row['date']);?></td>

                                                <td>
                                                    <a href="msg-view.php?msg_id=<?php echo $inbx_row['msg_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                    </a>

                                                    <a href="msg-reply.php?reply_msg_id=<?php echo $inbx_row['msg_id'];?>" data-placement="top" data-toggle="tooltip" title="Reply">
                                                        <button class="btn btn-default btn-xs" data-title="Reply" data-toggle="modal" data-target="#reply" style="background: #5cb85c;border-color: #4cae4c;color: white;">
                                                            <span class="glyphicon glyphicon-send"></span>
                                                        </button>
                                                    </a>
                                                    
                                                    <a href="?seen_msg_id=<?php echo $inbx_row['msg_id'];?>" onclick="return confirm('Are you sure to move this msg to seen box?');" data-placement="top" data-toggle="tooltip" title="Seen">
                                                        <button class="btn btn-default btn-xs" data-title="Seen" data-toggle="modal" data-target="#seen" style="background: #555;border-color: #666;color: white;">
                                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='9'><div class='alert alert-danger'>
                                                <strong>Inbox is Empty!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="col-md-12" style="padding-top: 80px;overflow: scroll;"> 
                        <?php
                        if(isset($_GET['seen_msg_id'])){
                            global $con;
                            $owner_email = $_SESSION['email'];
                            $seen_msg_id = $_GET['seen_msg_id'];
                            
                            $update_query = "UPDATE customer_message SET status='1' WHERE msg_id='$seen_msg_id' AND owner_email='$owner_email'";
                            $run_update_query = mysqli_query($con, $update_query);
                            if($run_update_query){
                                   echo "<script>alert('Message Sent Into Seen Box')</script>";
                                   echo "<script>window.open('owner-account.php','_self')</script>";
                                   
                                } else {
                                    echo "<script>alert('Error!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }
                        }elseif(isset($_GET['del_msg_id'])){
                            global $con;
                            $owner_email = $_SESSION['email'];
                            $del_msg_id = $_GET['del_msg_id'];
                            
                            $delquery = "DELETE FROM customer_message WHERE msg_id='$del_msg_id' AND owner_email='$owner_email'";
                            $del_msg= mysqli_query($con,$delquery);
                            if($del_msg){
                                    echo "<script>alert('Message Deleted Successfully')</script>";
                                   echo "<script>window.open('owner-account.php','_self')</script>";
                                   
                            } else {
                                echo "<script>alert('Message Not Deleted!')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";
                            }
                        }elseif(isset($_GET['unseen_msg_id'])){
                            global $con;
                            $owner_email = $_SESSION['email'];
                            $unseen_msg_id = $_GET['unseen_msg_id'];
                            
                            $update_query = "UPDATE customer_message SET status='0' WHERE msg_id='$unseen_msg_id' AND owner_email='$owner_email'";
                            $run_update_query = mysqli_query($con, $update_query);
                            if($run_update_query){
                                echo "<script>alert('Message Sent Into Inbox Back')</script>";
                                echo "<script>window.open('owner-account.php','_self')</script>";

                             } else {
                                 echo "<script>alert('Error!')</script>";
                                 echo "<script>window.open('owner-account.php','_self')</script>";
                             }
                        }
                        ?>
                        <h3 style="background: #72b70f;padding: 10px;color: white;font-weight: bold;">Seen Message</h3>
                        <table id="example3" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Message</th>                                   
                                    <th>Date</th>
                                    <th>Action</th>                                   
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_email = $_SESSION['email'];
                                $inbox_query = "SELECT * FROM customer_message WHERE status='1' AND owner_email='$owner_email' ORDER BY msg_id DESC";
                                $inbox_run_query  = mysqli_query($con, $inbox_query);
                                if($inbox_run_query){
                                    $i=1;
                                    $count = mysqli_num_rows($inbox_run_query);
                                    if($count>0){
                                         while ($inbx_row = mysqli_fetch_array($inbox_run_query)) {
                                ?>
                        
                                            <tr>
                                                <td></td>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $inbx_row['customer_name'];?></td>
                                                <td><?php echo $inbx_row['customer_email'];?></td>
                                                <td><?php echo $inbx_row['customer_phone_num'];?></td>
                                                <td><?php echo readMore($inbx_row['customer_message'],100);?></td>
                                                <td><?php echo dateFormat($inbx_row['date']);?></td>

                                                <td>
                                                    <a href="msg-view.php?msg_id=<?php echo $inbx_row['msg_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                    </a>
                                                    <a href="?del_msg_id=<?php echo $inbx_row['msg_id'];?>" onclick="return confirm('Are you sure to delete this msg?');" data-placement="top" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                    <a href="?unseen_msg_id=<?php echo $inbx_row['msg_id'];?>" onclick="return confirm('Are you sure to unseen this msg?');" data-placement="top" data-toggle="tooltip" title="Unseen">
                                                        <button class="btn btn-default btn-xs" data-title="Unseen" data-toggle="modal" data-target="#unseen" style="background: #555;border-color: #666;color: white;">
                                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='9'><div class='alert alert-danger'>
                                                <strong>Seen Message Box Is Empty!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/Inbox-->
                
                <!-- ADD Tenant-->
                <div class="tab-pane" id="addNewTenant">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['add_tenant'])){
                            global $con;                           
                            $owner_id = $_SESSION['owner_id'];
                            
                            $building_name = validate($_POST['building_name']);
                            $floor_num = validate($_POST['floor_num']);
                            $flat_num = validate($_POST['flat_num']);
                            $tenant_name = validate($_POST['tenant_name']);
                            $tenant_email = validate($_POST['tenant_email']);
                            $tenant_password = validate($_POST['tenant_password']);
                            $tenant_nid_num = validate($_POST['tenant_nid_num']);
                            $code = md5(uniqid(rand()));
                            
                            $building_name = mysqli_real_escape_string($con,$building_name);
                            $floor_num = mysqli_real_escape_string($con,$floor_num);
                            $flat_num = mysqli_real_escape_string($con,$flat_num);
                            $tenant_name = mysqli_real_escape_string($con,$tenant_name);
                            $tenant_email = mysqli_real_escape_string($con,$tenant_email);
                            $tenant_password = mysqli_real_escape_string($con,$tenant_password);
                            $tenant_nid_num = mysqli_real_escape_string($con,$tenant_nid_num);
                            
                            $email_nid_query = "SELECT * FROM tbl_tenant WHERE tenant_email='$tenant_email' OR tenant_nid_num='$tenant_nid_num'";
                            $result = mysqli_query($con, $email_nid_query);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                echo "<script>alert('This Email/NID Number allready exists! Please Try another one.')</script>";
                            }elseif(empty($building_name) || empty($floor_num) || empty($flat_num) || empty($tenant_name) || empty($tenant_email) || empty($tenant_password) || empty($tenant_nid_num)){ 
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }elseif (!filter_var($tenant_email,FILTER_VALIDATE_EMAIL)) {
                                echo "<script>alert('Invalid Email Address!')</script>";
                            }else{
                                $tenant_password = md5($tenant_password);
                                $add_tenant_query = "INSERT INTO tbl_tenant(owner_id, building_name, floor_num,flat_num, tenant_name, tenant_email, tenant_password, tenant_nid_num, code) 
                                                    VALUES('$owner_id','$building_name','$floor_num','$flat_num','$tenant_name','$tenant_email','$tenant_password','$tenant_nid_num','$code')";
                                $add_tenant = mysqli_query($con, $add_tenant_query);
                                
                                if($add_tenant){
                                    $message = "Hello $tenant_name,
                                                <br /><br />
                                                Welcome to Sarkar Bari!<br/>
                                                To complete your registration  please , just click following link<br/>
                                                <br /><br />
                                                <a href='http://localhost/sharkarbari.com/tenant-verify.php?email=$tenant_email&&code=$code'>Click HERE to Activate :)</a>
                                                <br /><br />
                                                Thanks,";

                                    $subject = "Confirm Registration";
                                    send_mail($tenant_email,$message,$subject);
                                    $msg = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Success!</strong>  We've sent an email to $tenant_email.
                                                Please click on the confirmation link in the email to create your account.  
                                            </div>
                                            ";
                                }else{
                                    echo "<script>alert('Tenant Add Falied!')</script>";
                                    //echo "<script>window.open('owner-account.php','_self')</script>";
                                }
                            }                           
                            
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST">

                            <!-- Form Name -->
                            <h2 style="text-align: center;">Add New Tenant</h2>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Building Name</label>  
                                <div class="col-md-9">
                                    <input id="buildingName" name="building_name" type="text" class="form-control input-md" >
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-9">
                                    <input id="floor_num" name="floor_num" type="number" class="form-control input-md" >
                                </div>
                            </div>               


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-9">
                                    <input id="flat_num" name="flat_num" type="text" class="form-control input-md" >
                                </div>
                            </div> 

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tanant_name">Tenant Name</label>  
                                <div class="col-md-9">
                                   <input id="tanant_name" name="tenant_name" type="text" class="form-control input-md" >
                                </div>
                            </div>             


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tenant_email">Tenant Email</label>  
                                <div class="col-md-9">
                                    <input id="tenant_email" name="tenant_email" type="email" class="form-control input-md" >
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tenant_password">Tenant Password(Temporary)</label>  
                                <div class="col-md-9">
                                    <input id="tenant_password" name="tenant_password" type="password"  class="form-control input-md" >
                                </div>
                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tenant_nid_num">Tenant NID Number()</label>  
                                <div class="col-md-9">
                                    <input id="tenant_nid_num" name="tenant_nid_num" type="number"  class="form-control input-md" >
                                </div>
                            </div>
 

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-10 control-label" for="submit"></label>
                                <div class="col-md-2">
                                    <button id="submit" name="add_tenant" class="btn btn-primary">Add Tenant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ADD Tenant -->
                
                <!-- Tenant List-->
                <div class="tab-pane" id="tenantList">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <div class="col-md-12" style="overflow: scroll;">
                            <table class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Tenant Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Building Name</th>                                   
                                        <th>Floor No.</th>
                                        <th>Flat No.</th>     
                                        <th>NID No.</th>
                                        <th>Joining Date</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    global $con;
                                    $owner_id = $_SESSION['owner_id'];
                                    $tenant_data_query = "SELECT * FROM  tbl_tenant WHERE owner_id='$owner_id' ORDER BY tenant_id DESC";
                                    $tenant_data  = mysqli_query($con, $tenant_data_query);
                                    if($tenant_data){
                                        $i=1;
                                        $count = mysqli_num_rows($tenant_data);
                                        if($count>0){
                                             while ($tenant_data_row = mysqli_fetch_array($tenant_data)) {
                                    ?>

                                                <tr>
                                                    
                                                    <td><?php echo $i++;?></td>
                                                    <td><img src="<?php echo $tenant_data_row['tenant_photo'];?>"/></td>
                                                    <td><?php echo $tenant_data_row['tenant_name'];?></td>
                                                    <td><?php echo $tenant_data_row['tenant_email'];?></td>
                                                    <td><?php echo "+880".$tenant_data_row['tenant_phone'];?></td>
                                                    <td><?php echo $tenant_data_row['building_name'];?></td>
                                                    <td><?php echo $tenant_data_row['floor_num'];?></td>
                                                    <td><?php echo $tenant_data_row['flat_num'];?></td>
                                                    <td><?php echo $tenant_data_row['tenant_nid_num'];?></td>
                                                    <td><?php echo dateFormat($tenant_data_row['date']);?></td>

                                                </tr>
                                    <?php
                                            }
                                        }else{
                                            echo "<tr><td colspan='10'><div class='alert alert-danger'>
                                                    <strong>Inbox is Empty!</strong> .
                                                 </div></td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/Tenant List-->
                
                <!-- ADD Notice-->
                <div class="tab-pane" id="addNotice">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['send_notice'])){
                            $owner_id = validate($_POST['owner_id']);
                            $owner_id = mysqli_real_escape_string($con,$owner_id);                           
                            
                            //$notice = validate($_POST['notice']);
                            $notice = mysqli_real_escape_string($con,$_POST['notice']);  
                            
                            if(empty($owner_id)|| empty($notice)){
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }else{
                                $insert_ownerNotice_query ="INSERT INTO tbl_owner_notice(owner_id, notice) VALUES('$owner_id','$notice')";
                                $insertOwnerNotice = mysqli_query($con, $insert_ownerNotice_query);
                                if($insertOwnerNotice){
                                    echo "<script>alert('Notice Sent Successfully!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }else{
                                    echo "<script>alert('Notice Not Sent!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST">

                            <input name="owner_id" type="hidden" class="form-control input-md" value="<?php echo $_SESSION['owner_id'];?>">

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="text-align: left;">Write Your Notice</label>  
                                <div class="col-md-7">
                                    <textarea name="notice" class="form-control tinymce"></textarea>
                                </div>
                            </div>

                           <div class="form-group">
                               <label class="col-md-8 control-label" for="submit"></label>
                               <div class="col-md-2">                               
                                   <button type="submit" class="btn btn-primary" name="send_notice">
                                      SEND NOTICE
                                   </button>
                               </div>
                               <div style="clear: both;"></div>
                           </div>
                       </form>
                    </div>
                </div>
                <!--/ADD Notice -->
                
                
                <?php
                if(isset($_GET['del_owner_notice_id'])){
                    global $con;
                    $del_owner_notice_id = $_GET['del_owner_notice_id'];
                    $owner_id = $_SESSION['owner_id'];
                    $del_notice_query = "DELETE FROM tbl_owner_notice WHERE owner_notice_id='$del_owner_notice_id' AND owner_id='$owner_id'";
                    $del_notice=mysqli_query($con, $del_notice_query);
                    if ($del_notice) {
                        echo "<script>alert('Notice Deleted Successfully!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }else{
                        echo "<script>alert('Notice Not Deleted!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }
                }
                ?>
                <!-- My Notice List-->
                <div class="tab-pane" id="noticeList">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL</th>    
                                    <th>Notice</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $notice_query = "SELECT * FROM  tbl_owner_notice WHERE owner_id='$owner_id' ORDER BY owner_notice_id DESC";
                                $notice  = mysqli_query($con, $notice_query);
                                if($notice){
                                    $i=1;
                                    $count = mysqli_num_rows($notice);
                                    if($count>0){
                                         while ($notice_row = mysqli_fetch_array($notice)) {
                                ?>

                                            <tr>
                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo readMore($notice_row['notice'],100);?></td>
                                                <td><?php echo dateFormat($notice_row['date']);?></td>

                                                <td>
                                                    <a href="?del_owner_notice_id=<?php echo $notice_row['owner_notice_id'];?>" onclick="return confirm('Are you sure to delete this notice?');" data-placement="top" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='4'><div class='alert alert-danger'>
                                                <strong>Inbox is Empty!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/My Notice List -->
                
                
                <?php
                if(isset($_GET['seen_notice_id'])){
                    global $con;
                    $seen_notice_id = $_GET['seen_notice_id'];
                    $update_notice_query = "UPDATE tbl_tenant_notice SET  status='1' WHERE tenant_notice_id='$seen_notice_id'";
                    $update_notice  = mysqli_query($con, $update_notice_query);
                    if($update_notice){
                        echo "<script>alert('Notice Sent Into Seen Box')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";

                     } else {
                         echo "<script>alert('Error!')</script>";
                         echo "<script>window.open('owner-account.php','_self')</script>";
                     }
                }
                ?>
                <!-- My Notice List-->
                <div class="tab-pane" id="tenantNotice">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Tenant Name</th>
                                    <th>Email</th>
                                    <th>Building Name</th>                                   
                                    <th>Floor No.</th>
                                    <th>Flat No.</th>     
                                    <th>Notice</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $notice_query = "SELECT * FROM  tbl_tenant_notice WHERE owner_id='$owner_id' AND status='0' ORDER BY tenant_notice_id DESC";
                                $notice  = mysqli_query($con, $notice_query);
                                if($notice){
                                    $i=1;
                                    $count = mysqli_num_rows($notice);
                                    if($count>0){
                                         while ($notice_row = mysqli_fetch_array($notice)) {
                                ?>

                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $notice_row['tenant_name'];?></td>
                                                <td><?php echo $notice_row['tenant_email'];?></td>
                                                <td><?php echo $notice_row['building_name'];?></td>
                                                <td><?php echo $notice_row['floor_num'];?></td>
                                                <td><?php echo $notice_row['flat_num'];?></td>
                                                <td><?php echo readMore($notice_row['notice'],100);?></td>
                                                <td><?php echo dateFormat($notice_row['date']);?></td>

                                                <td>
                                                    <a href="notice-view.php?notice_id=<?php echo $notice_row['tenant_notice_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                    </a>
                                                    
                                                    <a href="?seen_notice_id=<?php echo $notice_row['tenant_notice_id'];?>" onclick="return confirm('Are you sure to move this notice to seen box?');" data-placement="top" data-toggle="tooltip" title="Seen">
                                                        <button class="btn btn-default btn-xs" data-title="Seen" data-toggle="modal" data-target="#seen" style="background: #555;border-color: #666;color: white; margin: 5px 0;">
                                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='9'><div class='alert alert-danger'>
                                                <strong>Inbox is Empty!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <h3 style="background: #72b70f;padding: 10px;color: white;font-weight: bold;margin-top: 70px;">Seen Notice</h3>
                        <table class="table table-striped table-bordered" cellspacing="0" style="overflow: scroll;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Tenant Name</th>
                                    <th>Email</th>
                                    <th>Building Name</th>                                   
                                    <th>Floor No.</th>
                                    <th>Flat No.</th>     
                                    <th>Notice</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $notice_query = "SELECT * FROM  tbl_tenant_notice WHERE owner_id='$owner_id' AND status='1' ORDER BY tenant_notice_id DESC";
                                $notice  = mysqli_query($con, $notice_query);
                                if($notice){
                                    $i=1;
                                    $count = mysqli_num_rows($notice);
                                    if($count>0){
                                         while ($notice_row = mysqli_fetch_array($notice)) {
                                ?>

                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $notice_row['tenant_name'];?></td>
                                                <td><?php echo $notice_row['tenant_email'];?></td>
                                                <td><?php echo $notice_row['building_name'];?></td>
                                                <td><?php echo $notice_row['floor_num'];?></td>
                                                <td><?php echo $notice_row['flat_num'];?></td>
                                                <td><?php echo readMore($notice_row['notice'],100);?></td>
                                                <td><?php echo dateFormat($notice_row['date']);?></td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='8'><div class='alert alert-danger'>
                                                <strong>Inbox is Empty!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/My Notice List -->
                
                <div class="tab-pane" id="addRentAmountReceived">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if (isset($_POST['add_rent_amount'])) {
                            $owner_id = validate($_POST['owner_id']);
                            $owner_id = mysqli_real_escape_string($con,$owner_id);
                            
                            $owner_email = validate($_POST['owner_email']);
                            $owner_email = mysqli_real_escape_string($con,$owner_email);
                            
                            $building_name = validate($_POST['building_name']);
                            $building_name = mysqli_real_escape_string($con,$building_name);
                            
                            $floor_num = validate($_POST['floor_num']);
                            $floor_num = mysqli_real_escape_string($con,$floor_num);
                            
                            $flat_num = validate($_POST['flat_num']);
                            $flat_num = mysqli_real_escape_string($con,$flat_num);
                            
                            $rent_amount_received = validate($_POST['rent_amount_received']);
                            $rent_amount_received = mysqli_real_escape_string($con,$rent_amount_received);
                            
                            if(empty($owner_id) || empty($owner_email) ||empty($building_name) || empty($floor_num) || empty($flat_num) || empty($rent_amount_received) ){
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }else{
                                $insert_amount_query = "INSERT INTO tbl_owner_rent_received(owner_id, owner_email, building_name, floor_num, flat_num, rent_amount_received) 
                                                        VALUES('$owner_id','$owner_email','$building_name','$floor_num','$flat_num','$rent_amount_received')";
                                $insert_rent_amount = mysqli_query($con, $insert_amount_query);
                                if($insert_amount_query){
                                        echo "<script>alert('Rent Amount Inserted Successful!')</script>";
                                        echo "<script>window.open('owner-account.php','_self')</script>";
                                    }else{
                                        echo "<script>alert('Rent Amount Not Inserted!')</script>";
                                        echo "<script>window.open('owner-account.php','_self')</script>";
                                    }
                            }                    
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST">

                            <input name="owner_id" type="hidden" class="form-control input-md" value="<?php echo $_SESSION['owner_id'];?>">

                            <input id="tenant_email" name="owner_email" type="hidden" class="form-control input-md" value="<?php echo $_SESSION['email'];?>">
                    


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="building_name">Building Name</label>  
                                <div class="col-md-9">
                                    <input id="building_name" name="building_name" type="text" class="form-control input-md">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-9">
                                    <input id="floor_num" name="floor_num" type="number" class="form-control input-md">
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-9">
                                    <input id="flat_num" name="flat_num" type="text" class="form-control input-md">
                                </div>
                            </div>


                           <div class="form-group">
                               <label class="col-md-3 control-label" for="rent_amount_paid">Enter Rent Money Received(Tk)</label>  
                               <div class="col-md-9">
                                   <input id="rent_amount_paid" name="rent_amount_received" type="text"  class="form-control input-md">
                               </div>
                           </div>


                           <div class="form-group">
                               <label class="col-md-9 control-label" for="submit"></label>
                               <div class="col-md-3">                               
                                   <button type="submit" class="btn btn-primary" name="add_rent_amount">
                                       Add Rent Amount Received
                                   </button>
                               </div>
                               <div style="clear: both;"></div>
                           </div>
                       </form>
                    </div>
                </div>
                
                <div class="tab-pane" id="rentAmountDetails">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
                        <table id="example" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Rent Price Received(Tk)</th>                                 
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $total = 0;
                                $owner_id = $_SESSION['owner_id'];
                                $owner_email = $_SESSION['email'] ;
                                $rent_amount_query = "SELECT * FROM tbl_owner_rent_received WHERE owner_id='$owner_id' AND owner_email='$owner_email' ORDER BY rent_received_id DESC";
                                $rent_amount_result = mysqli_query($con, $rent_amount_query);
                                if($rent_amount_result){
                                    $i=1;
                                    $count = mysqli_num_rows($rent_amount_result);
                                    if($count>0){
                                        while($rrow = mysqli_fetch_array($rent_amount_result)){
                                            $rent_amount = array($rrow['rent_amount_received']);
                                            $values = array_sum($rent_amount);
                                            $total += $values;
                                ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $rrow['building_name'];?></td>
                                                <td><?php echo $rrow['floor_num'];?></td>
                                                <td><?php echo $rrow['flat_num'];?></td>
                                                <td><?php echo number_format($rrow['rent_amount_received'],2);?></td>
                                                <td><?php echo dateFormat($rrow['date']);?></td>

                                            </tr>
                                <?php
                                        }
                                ?>
                                            
                                            <tr>                                              
                                                <td align="right" colspan="4">
                                                    <strong>Total Amount Received</strong>
                                                </td>
                                                <td>
                                                    <strong><?php echo number_format($total,2)."Tk";?></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            
                                <?php
                                    }else{
                                        echo "<tr><td colspan='6'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Send Personal Notice-->
                <div class="tab-pane" id="sendPersonalNotice">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['send_personal_notice'])){
                            global $con;
                            $owner_id = validate($_POST['owner_id']);
                            $owner_id = mysqli_real_escape_string($con,$owner_id);                           
                            
                            $tenant_email = validate($_POST['tenant_email']);
                            $tenant_email = mysqli_real_escape_string($con,$tenant_email); 

                            $personal_notice = mysqli_real_escape_string($con,$_POST['personal_notice']); 
                            
                            if(empty($owner_id)|| empty($tenant_email) || empty($personal_notice)){
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }elseif (!filter_var($tenant_email,FILTER_VALIDATE_EMAIL)) {
                                echo "<script>alert('Enter a valid email!')</script>";                               
                            }else{
                                $send_personal_notice_query ="INSERT INTO tbl_owner_to_tenant_personal_notice(owner_id,tenant_email, notice) VALUES('$owner_id','$tenant_email','$personal_notice')";
                                $insertOwnerPersonalNotice = mysqli_query($con, $send_personal_notice_query);
                                if($insertOwnerPersonalNotice){
                                    echo "<script>alert('Notice Sent Successfully!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }else{
                                    echo "<script>alert('Notice Not Sent!')</script>";
                                    echo "<script>window.open('owner-account.php','_self')</script>";
                                }
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST">

                            <input name="owner_id" type="hidden" class="form-control input-md" value="<?php echo $_SESSION['owner_id'];?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tenant_email">Tenant Email</label>  
                                <div class="col-md-7">
                                    <input id="tenant_email" name="tenant_email" type="email" class="form-control input-md">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Write Your Notice</label>  
                                <div class="col-md-7">
                                    <textarea name="personal_notice" class="form-control tinymce"></textarea>
                                </div>
                            </div>

                           <div class="form-group">
                               <label class="col-md-8 control-label" for="submit"></label>
                               <div class="col-md-2">                               
                                   <button type="submit" class="btn btn-primary" name="send_personal_notice">
                                      SEND NOTICE
                                   </button>
                               </div>
                               <div style="clear: both;"></div>
                           </div>
                       </form>
                    </div>
                </div>
                <!--/Send Personal Notice -->
                
                <?php
                if(isset($_GET['del_personal_notice_id'])){
                    global $con;
                    $del_personal_notice_id = $_GET['del_personal_notice_id'];
                    $owner_id = $_SESSION['owner_id'];
                    $del_personal_notice_query = "DELETE FROM tbl_owner_to_tenant_personal_notice WHERE notice_id='$del_personal_notice_id' AND owner_id='$owner_id'";
                    $del_personal_notice=mysqli_query($con, $del_personal_notice_query);
                    if ($del_personal_notice) {
                        echo "<script>alert('Notice Deleted Successfully!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }else{
                        echo "<script>alert('Notice Not Deleted!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }
                }
                ?>
                <!-- My Notice List-->
                <div class="tab-pane" id="personalNoticeList">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Tenant Email</th> 
                                    <th>Notice</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $personal_notice_query = "SELECT * FROM  tbl_owner_to_tenant_personal_notice WHERE owner_id='$owner_id' ORDER BY notice_id DESC";
                                $notice_result  = mysqli_query($con, $personal_notice_query);
                                if($notice_result){
                                    $i=1;
                                    $count = mysqli_num_rows($notice_result);
                                    if($count>0){
                                         while ($personal_notice_row = mysqli_fetch_array($notice_result)) {
                                ?>

                                            <tr>                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $personal_notice_row['tenant_email'];?></td>
                                                <td><?php echo readMore($personal_notice_row['notice'],100);?></td>
                                                <td><?php echo dateFormat($personal_notice_row['date']);?></td>

                                                <td>
                                                    <a href="?del_personal_notice_id=<?php echo $personal_notice_row['notice_id'];?>" onclick="return confirm('Are you sure to delete this notice?');" data-placement="top" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='5'><div class='alert alert-danger'>
                                                <strong>No data availble!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/My Notice List -->
                <!-- Tenant rent received confirmation List-->
                <?php
                if(isset($_GET['confirm_rent_paid_id'])){
                    global $con;
                    $confirm_rent_paid_id = mysqli_real_escape_string($con,$_GET['confirm_rent_paid_id']);
                    $owner_id = $_SESSION['owner_id'];
                    $confirm_rent_paid_id_query = "UPDATE tbl_tenant_rent_paid SET confirm='Y' WHERE rent_paid_id='$confirm_rent_paid_id' AND owner_id='$owner_id'";
                    $confirm=mysqli_query($con, $confirm_rent_paid_id_query);
                    if ($confirm) {
                        echo "<script>alert('Confirmed Successfully!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }else{
                        echo "<script>alert('Not Confirmed!')</script>";
                        echo "<script>window.open('owner-account.php','_self')</script>";
                    }
                }
                ?>
                <div class="tab-pane" id="rentReceivedConfirm">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>SL</th>
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Building Name</th>                    
                                    <th>Floor No.</th>
                                    <th>Flat No.</th>
                                    <th>Rent Price Paid(Tk)</th>                                 
                                    <th>Date</th>
                                    <th>Confirm</th>
                                
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                global $con;
                                $owner_id = $_SESSION['owner_id'];
                                $rent_paid_by_tenant_confirmation_query = "SELECT * FROM  tbl_tenant_rent_paid  WHERE owner_id='$owner_id' AND confirm='N'";
                                $rent_paid_result  = mysqli_query($con, $rent_paid_by_tenant_confirmation_query);
                                if($rent_paid_result){
                                    $i=1;
                                    $count = mysqli_num_rows($rent_paid_result);
                                    if($count>0){
                                         while ($tenat_rent_paid_row = mysqli_fetch_array($rent_paid_result)) {
                                ?>

                                            <tr>                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $tenat_rent_paid_row['tenant_name'];?></td>
                                                <td><?php echo $tenat_rent_paid_row['tenant_email'];?></td>
                                                <td><?php echo $tenat_rent_paid_row['building_name'];?></td>
                                                <td><?php echo $tenat_rent_paid_row['floor_num'];?></td>
                                                <td><?php echo $tenat_rent_paid_row['floor_num'];?></td>
                                                <td><?php echo number_format($tenat_rent_paid_row['rent_amount_paid'],2);?></td>
                                                <td><?php echo dateFormat($tenat_rent_paid_row['paid_date']);?></td>

                                                <td>
                                                    <a href="?confirm_rent_paid_id=<?php echo $tenat_rent_paid_row['rent_paid_id'];?>" onclick="return confirm('Are sure to comfirm?');" data-placement="top" data-toggle="tooltip" title="Confirm">
                                                        <button class="btn btn-danger btn-xs" data-title="Confirm" data-toggle="modal" data-target="#confirm" >
                                                            <span class="glyphicon glyphicon-ok"></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='9'><div class='alert alert-danger'>
                                                <strong>No data availble!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/Tenant rent received confirmation List -->

            </div>   <!--/tab content--> 
        </div>
    </div>
</section>
<?php
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d');
list($y, $m, $d) = explode('-', $date);
if ($d == '1' || $d == '5' || $d == '10') {
    echo    '<div id="modal" style="position:fixed;left:0;top:32%;z-index:99999;width:100%;">
                <div class="modal-dialog">

                  <!-- Modal content-->
                    <div class="modal-content" style="background:darkred;">
                        <div class="modal-header" >
                            <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;">&times;</button>
                            <h4 class="modal-title" style="color:white;">Alert Notice</h4>
                        </div>
                        <div class="modal-body">
                            <p style="color:white;">It\'s time to recieve the rent from tenants</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close1" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>';
}
?>
<script>
    $(document).ready(function(){
        $(".close,.close1").click(function() {
            $("#modal").hide();
        })
    });
</script>
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
<script>
$(document).ready(function() {
    $('#example,#example1,#example2,#example4,#example5,#example6').DataTable();

    $("[data-toggle=tooltip]").tooltip();
} );
</script>
<?php include'include/footer.php';?>
