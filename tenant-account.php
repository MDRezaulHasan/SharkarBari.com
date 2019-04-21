<?php 
session_start();
if (!isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';
global $con;

include'include/header.php';
?>

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
    <div class="container">
        <div class="row owner-account">
            <?php
            if(isset($_SESSION['tenant_email'])){
                
                $tenant_id    = $_SESSION['tenant_id'];
                $tenant_email = $_SESSION['tenant_email'];
                $query = "SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id' AND tenant_email='$tenant_email'";
                $result = mysqli_query($con, $query);
                if($result){
                    $row = mysqli_fetch_array($result);
                }
            }

            ?>
            <div class="panel">
                <?php
                if($row['tenant_photo']==true){
               ?>
                <img class="pic img-circle" src="<?php echo $row['tenant_photo'];?>" alt="...">
                <?php
                }else{
                ?>
                <img class="pic img-circle" src="images/images.png" alt="...">
                <?php    
                }
                ?>               
                <div class="name"><small><?php echo $row['tenant_name'];?></small></div>               
            </div>
            <br><br><br>
            
            <!--tab header-->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#myinfo" data-toggle="tab"><i class="fa fa-info-circle"></i> My Info.</a></li>
                <li><a href="#profilePhoto" data-toggle="tab"><i class="fa fa-picture-o"></i> Upload Profile Photo</a></li>
                <li><a href="#updatePassword" data-toggle="tab"><i class="fa fa-key"></i> Update Password</a></li>
                <li><a href="#addRentAmountPaid" data-toggle="tab"><i class="fa fa-usd"></i> Add Rent Amount Paid For Each Month</a></li>
                <li><a href="#myPaymentDetails" data-toggle="tab"><i class="fa fa-usd"></i> My Payment Details</a></li>  
                <li><a href="#postNoticeToOwner" data-toggle="tab"><i class="fa fa-file-text-o"></i> Write Notice To Owner</a></li>
                <li><a href="#sentNoticeList" data-toggle="tab"><i class="fa fa-file-text-o"></i> My Sent Notice List</a></li>
                <li>
                    <a href="#inbox" data-toggle="tab"><i class="fa fa-flag"></i> 
                        Notice From Owner
                        <?php
                            global $con;
                            $tenant_id = $_SESSION['tenant_id'];
                            $tenant_details_query="SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id'";
                            $tenant_details = mysqli_query($con, $tenant_details_query);
                            if($tenant_details){
                                $data=mysqli_fetch_array($tenant_details);
                                $owner_notice_id=$data['owner_id'];
                            }

                            $notice_query = "SELECT * FROM  tbl_owner_notice WHERE owner_id='$owner_notice_id'";
                            $notice  = mysqli_query($con, $notice_query);
                            if($notice){
                                $count = mysqli_num_rows($notice);
                                echo "(".$count.")";
                            }else{
                                echo "(0)";
                            }
                        ?>
                    </a>
                </li>    
                <li><a href="#personalNoticeFromOwner" data-toggle="tab"><i class="fa fa-flag"></i> 
                        Personal Notice From Owner
                        <?php
                            global $con;
                                $tenant_email = $_SESSION['tenant_email'];
                                $tenant_notice_query="SELECT * FROM tbl_owner_to_tenant_personal_notice WHERE tenant_email='$tenant_email' ORDER BY notice_id DESC";
                                $notice_result = mysqli_query($con, $tenant_notice_query);
                            if($notice_result){
                                $count = mysqli_num_rows($notice_result);
                                echo "(".$count.")";
                            }else{
                                echo "(0)";
                            }
                        ?>
                    </a>
                </li>
            </ul>
            <!--tab body-->
            <div class="tab-content">
                <!--Tenant Account Information-->
                <div class="tab-pane active" id="myinfo">
                    <?php
                    if(isset($_POST['update_profile'])){
                        $tenant_id    = $_SESSION['tenant_id'];
                        $t_email = $_SESSION['tenant_email'];
                        
                        $tenant_name = validate($_POST['tenant_name']);
                        $tenant_name = mysqli_real_escape_string($con,$tenant_name);                    
                        
                        $tenant_phone = validate($_POST['tenant_phone']);
                        $tenant_phone = mysqli_real_escape_string($con,$tenant_phone);
                        
                        $tenant_nid_num = validate($_POST['tenant_nid_num']);
                        $tenant_nid_num = mysqli_real_escape_string($con,$tenant_nid_num);
                        
                        if(empty($tenant_name) || empty($tenant_phone) || empty($tenant_nid_num)){
                            $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                                </div>";
                        }else{
                            $update_query = "UPDATE tbl_tenant SET tenant_name='$tenant_name',tenant_phone='$tenant_phone',tenant_nid_num='$tenant_nid_num' WHERE tenant_id='$tenant_id' AND tenant_email='$t_email'";
                            $update_tenant_details = mysqli_query($con, $update_query);
                            if($update_tenant_details){
                                echo "<script>alert('Profile Updated Successfully!')</script>";
                                echo "<script>window.open('tenant-account.php','_self')</script>";
                            }else{
                                echo "<script>alert('Profile Not Updated Successfully!')</script>";
                                echo "<script>window.open('tenant-account.php','_self')</script>";
                            }
                            
                        }
                    }
                    ?>
                    <form class="form-horizontal" action="" method="POST">
                         <?php
                            if(isset($msg))
                            {
                                echo $msg;               
                            }
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="tenant_name">Name</label>  
                            <div class="col-md-9">
                                <input id="tenant_name" name="tenant_name" type="text" class="form-control input-md" value="<?php echo $row['tenant_name'];?>">
                            </div>
                        </div>

                                                         
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="tenant_email">Email</label>  
                            <div class="col-md-9">
                                <input id="tenant_email" name="tenant_email" type="email" class="form-control input-md" value="<?php echo $row['tenant_email'];?>" readonly>
                            </div>
                        </div>                      

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="tenant_phone">Phone No.(+880)</label>  
                            <div class="col-md-9">
                                <input id="tenant_phone" name="tenant_phone" type="tel" class="form-control input-md" value="<?php echo $row['tenant_phone'];?>">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="tenant_nid_num">National Identity  Number(NID)</label>  
                            <div class="col-md-9">
                                <input id="tenant_nid_num" name="tenant_nid_num" type="number"  class="form-control input-md" value="<?php echo $row['tenant_nid_num'];?>">
                            </div>
                        </div>

                      
                        <div class="form-group">
                            <label class="col-md-10 control-label" for="submit"></label>
                            <div class="col-md-2">                               
                                <button type="submit" class="btn btn-primary" name="update_profile">
                                    Update Profile
                                </button>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </form>
                </div>
                <!--/Tenant Account Information-->
                
                <!--Upload Profile Photo-->
                <div class="tab-pane" id="profilePhoto">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php                            
                            if(isset($_POST['upload_profile_photo'])){
                                
                                $tenant_id    = $_SESSION['tenant_id'];
                                $t_email = $_SESSION['tenant_email'];
                                
                                $permitted    = array('jpg','png','jpeg','gif');
                                $profile_image_name    = $_FILES['tenant_photo']['name'];
                                $profile_image_size    = $_FILES['tenant_photo']['size'];
                                $profile_image_temp    = $_FILES['tenant_photo']['tmp_name'];

                                $division          = explode('.', $profile_image_name);
                                $profile_image_ext     = strtolower(end($division));
                                $unique_profile_image = substr(md5(time()), 0, 10).'.'.$profile_image_ext;
                                $upload_profile_image = "tenant-upload/".$unique_profile_image;
                                
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
                                    $upload_query = "UPDATE tbl_tenant SET tenant_photo='$upload_profile_image' WHERE tenant_id='$tenant_id' AND tenant_email='$t_email'";
                                    $result = mysqli_query($con, $upload_query);
                                    if($result){
                                        echo "<script>alert('Image Uploaded Successfully!')</script>";
                                        echo "<script>window.open('tenant-account.php','_self')</script>";
                                    }else{
                                        echo "<script>alert('Image Not Uploaded!')</script>";
                                        echo "<script>window.open('tenant-account.php','_self')</script>";
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
                                <label class="col-md-3 control-label" for="tenant_photo">Upload Your Profile Photo</label>  
                                <div class="col-md-4">
                                    <input id="tenant_photo" name="tenant_photo" type="file" accept="image/*" onchange="preview_image(event)"  class="form-control input-md" >                   
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
                            $tenant_id    = $_SESSION['tenant_id'];
                            $t_email = $_SESSION['tenant_email'];
                        
                            $old_password = validate(md5($_POST['old_password']));
                            $old_password = mysqli_real_escape_string($con,$old_password);
                            
                            $new_password = validate(md5($_POST['new_password']));
                            $new_password = mysqli_real_escape_string($con,$new_password);
                            
                            $cf_password = validate(md5($_POST['cf_password']));
                            $cf_password = mysqli_real_escape_string($con,$cf_password);
                            
                            $match_old_pw_query = "SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id' AND tenant_email='$t_email'";
                            $match_old_pw = mysqli_query($con, $match_old_pw_query);
                            
                            if($match_old_pw){
                                $match_old_pw_row = mysqli_fetch_array($match_old_pw);
                            }
                            
                            
                            if (empty ($old_password)||empty ($new_password)||empty ($cf_password)) {
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }elseif ($old_password !== $match_old_pw_row['tenant_password']) {
                                echo "<script>alert('Your Old Password Not Matched! Try Again.')</script>";
                            } elseif ($new_password !== $cf_password) {
                                echo "<script>alert('New Password And Confirm Password Not Matched!')</script>";
                            }else{
                                $update_password_query = "UPDATE tbl_tenant SET tenant_password='$cf_password' WHERE tenant_id='$tenant_id' AND tenant_email='$t_email'";
                                $update_password = mysqli_query($con, $update_password_query);
                                if($update_password){
                                    echo "<script>alert('Password Updated Successfully!')</script>";
                                    echo "<script>window.open('tenant-account.php','_self')</script>";
                                } else {
                                    echo "<script>alert('Password Not Updated!')</script>";
                                    echo "<script>window.open('tenant-account.php','_self')</script>";
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
                
                <!-- Add Rent Amount Paid-->
                <div class="tab-pane" id="addRentAmountPaid">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['add_rent_amount'])){
                            $tenant_id = validate($_POST['tenant_id']);
                            $tenant_id = mysqli_real_escape_string($con,$tenant_id);
                            
                            $tenant_name = validate($_POST['tenant_name']);
                            $tenant_name = mysqli_real_escape_string($con,$tenant_name);
                            
                            $tenant_email = validate($_POST['tenant_email']);
                            $tenant_email = mysqli_real_escape_string($con,$tenant_email);
                            
                            $owner_id = validate($_POST['owner_id']);
                            $owner_id = mysqli_real_escape_string($con,$owner_id);
                            
                            $building_name = validate($_POST['building_name']);
                            $building_name = mysqli_real_escape_string($con,$building_name);
                            
                            $floor_num = validate($_POST['floor_num']);
                            $floor_num = mysqli_real_escape_string($con,$floor_num);
                            
                            $flat_num = validate($_POST['flat_num']);
                            $flat_num = mysqli_real_escape_string($con,$flat_num);
                            
                            $rent_amount_paid = validate($_POST['rent_amount_paid']);
                            $rent_amount_paid = mysqli_real_escape_string($con,$rent_amount_paid);
                            
                            if(empty($tenant_id) || empty($tenant_name) || empty($tenant_email) || empty($owner_id) ||empty($building_name) || empty($floor_num) || empty($flat_num) || empty($rent_amount_paid) ){
                                $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                                </div>";
                            }else{
                                $insert_amount_query = "INSERT INTO tbl_tenant_rent_paid(tenant_id, tenant_name, tenant_email, owner_id, building_name, floor_num, flat_num, rent_amount_paid) 
                                                        VALUES('$tenant_id','$tenant_name','$tenant_email','$owner_id','$building_name','$floor_num','$flat_num','$rent_amount_paid')";
                                $insert_rent_amount = mysqli_query($con, $insert_amount_query);
                                if($insert_amount_query){
                                        echo "<script>alert('Rent Amount Inserted Successful!')</script>";
                                        echo "<script>window.open('tenant-account.php','_self')</script>";
                                    }else{
                                        echo "<script>alert('Rent Amount Not Inserted!')</script>";
                                        echo "<script>window.open('tenant-account.php','_self')</script>";
                                    }
                            }
                            
                            
                            
                        }
                        ?>
                        <?php
                        $tenant_id    = $_SESSION['tenant_id'];
                        $t_email = $_SESSION['tenant_email'];
                        $tenant_data_query = "SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id' AND tenant_email='$t_email'";
                        $result = mysqli_query($con, $tenant_data_query);
                        if($result){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        
                        
                        <form class="form-horizontal" action="" method="POST">
                            <?php
                               if(isset($msg))
                               {
                                   echo $msg;               
                               }
                           ?>
                            
                            <input name="tenant_id" type="hidden" class="form-control input-md" value="<?php echo $row['tenant_id'];?>">

                            <input name="tenant_name" type="hidden" class="form-control input-md" value="<?php echo $row['tenant_name'];?>">

                            <input name="tenant_email" type="hidden" class="form-control input-md" value="<?php echo $row['tenant_email'];?>" readonly>
                    
                            <input name="owner_id" type="hidden" class="form-control input-md" value="<?php echo $row['owner_id'];?>" readonly> 
                            

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="building_name">Building Name</label>  
                                <div class="col-md-9">
                                    <input id="building_name" name="building_name" type="text" class="form-control input-md" value="<?php echo $row['building_name'];?>" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-9">
                                    <input id="floor_num" name="floor_num" type="num" class="form-control input-md" value="<?php echo $row['floor_num'];?>" readonly>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-9">
                                    <input id="flat_num" name="flat_num" type="text" class="form-control input-md" value="<?php echo $row['flat_num'];?>" readonly>
                                </div>
                            </div>


                           <div class="form-group">
                               <label class="col-md-3 control-label" for="rent_amount_paid">Enter Rent Money Paid This Month(Tk)</label>  
                               <div class="col-md-9">
                                   <input id="rent_amount_paid" name="rent_amount_paid" type="number"  class="form-control input-md">
                               </div>
                           </div>


                           <div class="form-group">
                               <label class="col-md-10 control-label" for="submit"></label>
                               <div class="col-md-2">                               
                                   <button type="submit" class="btn btn-primary" name="add_rent_amount">
                                       Add Rent Amount Paid
                                   </button>
                               </div>
                               <div style="clear: both;"></div>
                           </div>
                       </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!--/Add Rent Amount Paid-->
                
                <!--My Payment Details-->
                <div class="tab-pane" id="myPaymentDetails">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
                        <table id="example" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr>
                     
                                    <th>SL</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Rent Price Paid(Tk)</th>                                 
                                    <th>Date</th>
                                    <th>Confirmed</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $total = 0;
                                $tenant_id    = $_SESSION['tenant_id'];
                                $t_email = $_SESSION['tenant_email'];
                                $rent_amount_query = "SELECT * FROM tbl_tenant_rent_paid WHERE tenant_id='$tenant_id' AND tenant_email='$t_email' ORDER BY rent_paid_id DESC";
                                $rent_amount_result = mysqli_query($con, $rent_amount_query);
                                if($rent_amount_result){
                                    $i=1;
                                    $count = mysqli_num_rows($rent_amount_result);
                                    if($count>0){
                                        while($rrow = mysqli_fetch_array($rent_amount_result)){
                                            $rent_amount = array($rrow['rent_amount_paid']);
                                            $values = array_sum($rent_amount);
                                            $total += $values;
                                ?>
                                            <tr>
                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $rrow['building_name'];?></td>
                                                <td><?php echo $rrow['floor_num'];?></td>
                                                <td><?php echo $rrow['flat_num'];?></td>
                                                <td><?php echo number_format($rrow['rent_amount_paid'],2);?></td>
                                                <td><?php echo dateFormat($rrow['paid_date']);?></td>
                                                <td>
                                                    <?php
                                                    if($rrow['confirm'] == 'Y'){
                                                        echo 'Yes';
                                                    }else{
                                                        echo 'No';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                ?>
                                            
                                            <tr>
                                                <td align="right" colspan="4">
                                                    <strong>Total Amount Paid</strong>
                                                </td>
                                                <td>
                                                    <strong><?php echo number_format($total,2)."Tk";?></strong>
                                                </td>
                                                <td colspan="2"></td>
                                            </tr>
                                            
                                <?php
                                    }else{
                                        echo "<tr><td colspan='7'><div class='alert alert-danger'>
                                                <strong>No Ads Found!</strong> .
                                             </div></td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/My Payment Details-->
                
                <div class="tab-pane" id="postNoticeToOwner">
                    <div class="col-md-12" style="padding-top: 20px;">
                        <?php
                        if(isset($_POST['send_notice'])){
                            $owner_id = validate($_POST['owner_id']);
                            $owner_id = mysqli_real_escape_string($con,$owner_id);
                            
                            $tenant_id = validate($_POST['tenant_id']);
                            $tenant_id = mysqli_real_escape_string($con,$tenant_id);
                            
                            $tenant_name = validate($_POST['tenant_name']);
                            $tenant_name = mysqli_real_escape_string($con,$tenant_name);
                            
                            $tnt_email = validate($_POST['tenant_email']);
                            $tnt_email = mysqli_real_escape_string($con,$tnt_email);
                            
                            $building_name = validate($_POST['building_name']);
                            $building_name = mysqli_real_escape_string($con,$building_name);
                            
                            $floor_num = validate($_POST['floor_num']);
                            $floor_num = mysqli_real_escape_string($con,$floor_num);
                            
                            $flat_num = validate($_POST['flat_num']);
                            $flat_num = mysqli_real_escape_string($con,$flat_num);
                            
                            //$notice = validate($_POST['notice']);
                            $notice = mysqli_real_escape_string($con,$_POST['notice']);
                            
                            if(empty($owner_id)||empty($tenant_id)||empty($tenant_name)||empty($tenant_email)||empty($building_name)||empty($floor_num)||empty($flat_num)||empty($notice)){
                                echo "<script>alert('Input Field Must Not Be Empty!')</script>";
                            }else{
                                $insert_tenantNotice_query ="INSERT INTO tbl_tenant_notice(owner_id, tenant_id, tenant_name, tenant_email, building_name, floor_num, flat_num, notice) VALUES('$owner_id','$tenant_id','$tenant_name','$tnt_email','$building_name','$floor_num','$flat_num','$notice')";
                                $insertTenantNotice = mysqli_query($con, $insert_tenantNotice_query);
                                if($insertTenantNotice){
                                    echo "<script>alert('Notice Sent Successfully!')</script>";
                                    echo "<script>window.open('tenant-account.php','_self')</script>";
                                }else{
                                    echo "<script>alert('Notice Not Sent!')</script>";
                                    echo "<script>window.open('tenant-account.php','_self')</script>";
                                }
                            }
                        }
                        ?>
                        <?php
                        $tenant_id    = $_SESSION['tenant_id'];
                        $tenant_email = $_SESSION['tenant_email'];
                        $tenant_info_query = "SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id' AND tenant_email='$tenant_email'";
                        $tenant_info = mysqli_query($con, $tenant_info_query);
                        if($tenant_info){
                            while($tenant_info_row = mysqli_fetch_array($tenant_info)){
                        ?>
                        
                       
                        <form class="form-horizontal" action="" method="POST">

                            <input name="owner_id" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['owner_id'];?>">
                            <input name="tenant_id" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['tenant_id'];?>">
                            <input name="tenant_name" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['tenant_name'];?>">
                            <input name="tenant_email" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['tenant_email'];?>">
                            <input name="building_name" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['building_name'];?>">
                            <input name="floor_num" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['floor_num'];?>">
                            <input name="flat_num" type="hidden" class="form-control input-md" value="<?php echo $tenant_info_row['flat_num'];?>">


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
                         <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                
                
                <?php
                if(isset($_GET['del_tenant_notice_id'])){
                    global $con;
                    $del_tenant_notice_id=$_GET['del_tenant_notice_id'];
                    $tnt_id = $_SESSION['tenant_id'];
                    $del_query = "DELETE FROM tbl_tenant_notice WHERE tenant_notice_id='$del_tenant_notice_id' AND tenant_id='$tnt_id'";
                    $del_notice=mysqli_query($con, $del_query);
                    if ($del_notice) {
                        echo "<script>alert('Notice Deleted Successfully!')</script>";
                        echo "<script>window.open('tenant-account.php','_self')</script>";
                    }else{
                        echo "<script>alert('Notice Not Deleted!')</script>";
                        echo "<script>window.open('tenant-account.php','_self')</script>";
                    }
                }
                ?>
                <div class="tab-pane" id="sentNoticeList">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
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
                                $t_id = $_SESSION['tenant_id'];
                                $tenant_notice_query = "SELECT * FROM  tbl_tenant_notice WHERE tenant_id='$t_id' ORDER BY tenant_notice_id DESC";
                                $tenant_notice  = mysqli_query($con, $tenant_notice_query);
                                if($tenant_notice){
                                    $i=1;
                                    $count = mysqli_num_rows($tenant_notice);
                                    if($count>0){
                                         while ($value = mysqli_fetch_array($tenant_notice)) {
                                ?>

                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo readMore($value['notice'],100);?></td>
                                                <td><?php echo dateFormat($value['date']);?></td>

                                                <td>
                                                    <a href="?del_tenant_notice_id=<?php echo $value['tenant_notice_id'];?>" onclick="return confirm('Are you sure to delete this notice?');" data-placement="top" data-toggle="tooltip" title="Delete">
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
                
                <div class="tab-pane" id="inbox">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
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
                                $tenant_id = $_SESSION['tenant_id'];
                                $tenant_details_query="SELECT * FROM tbl_tenant WHERE tenant_id='$tenant_id'";
                                $tenant_details = mysqli_query($con, $tenant_details_query);
                                if($tenant_details){
                                    $data=mysqli_fetch_array($tenant_details);
                                    $owner_notice_id=$data['owner_id'];
                                }
                                
                                $notice_query = "SELECT * FROM  tbl_owner_notice WHERE owner_id='$owner_notice_id'";
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
                                                    <a href="tenant-notice-view.php?notice_id=<?php echo $notice_row['owner_notice_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
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
                
                <div class="tab-pane" id="personalNoticeFromOwner">
                    <div class="col-md-12" style="padding-top: 20px;overflow: scroll;">
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
                                $tenant_email = $_SESSION['tenant_email'];
                                $tenant_notice_query="SELECT * FROM tbl_owner_to_tenant_personal_notice WHERE tenant_email='$tenant_email' ORDER BY notice_id DESC";
                                $notice_result = mysqli_query($con, $tenant_notice_query);
                                if($notice_result){
                                    
                                    $i=1;
                                    $count = mysqli_num_rows($notice_result);
                                    if($count>0){
                                         while ($personal_notice_row = mysqli_fetch_array($notice_result)) {
                                ?>

                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo readMore($personal_notice_row['notice'],100);?></td>
                                                <td><?php echo dateFormat($personal_notice_row['date']);?></td>

                                                <td>
                                                    <a href="personal-notice-view.php?personal_notice_id=<?php echo $personal_notice_row['notice_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
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
                
                
            </div>
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
                            <p style="color:white;">It\'s time to pay the rent to flat owner</p>
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
    $('#example,#example1').DataTable();

    $("[data-toggle=tooltip]").tooltip();
} );
</script>
<?php include'include/footer.php';?>
