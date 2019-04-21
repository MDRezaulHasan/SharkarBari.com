<?php 
include 'inc/header.php';
global $con;
if(isset($_GET['unban_tenant_id'])){
    $unban_tenant_id = mysqli_real_escape_string($con,$_GET['unban_tenant_id']);
    $unban_query = "UPDATE tbl_tenant SET ban='0' WHERE tenant_id='$unban_tenant_id'";
    $unban_tenant = mysqli_query($con, $unban_query);
    if($unban_tenant){
        echo "<script>alert('This Tenant is Unbanned!')</script>";
        echo "<script>window.open('banned-tenant.php','_self')</script>";
    }else{
        echo "<script>alert('This Tenant is not Unbanned!')</script>";
        echo "<script>window.open('banned-tenant.php','_self')</script>";
    }
} elseif (isset($_GET['delete_tenant_id'])) {
    $delete_tenant_id = mysqli_real_escape_string($con,$_GET['delete_tenant_id']);    
    
    $delete_query = "DELETE FROM tbl_tenant WHERE tenant_id='$delete_tenant_id'";
    $delete_tenant = mysqli_query($con, $delete_query);
    if($delete_tenant){
        echo "<script>alert('This Tenant is Deleted!')</script>";
        echo "<script>window.open('banned-tenant.php','_self')</script>";
    }else{
        echo "<script>alert('This Tenant is not Delete!')</script>";
        echo "<script>window.open('banned-tenant.php','_self')</script>";
    }
}
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-user"></i>&nbsp; Tenant's List
        </h3>
    </div>
    <!--In Which Page We Are Name Section End-->

<?php include 'inc/sidebar.php';?>
            
    <!--Main Body Content Section Start-->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">                                              
                <div class="row">
                    <div class="col-md-12"   style="margin-top:50px;margin-bottom: 50px;">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>NID No.</th>  
                                    <th>Building Name</th>
                                    <th>Floor No.</th>
                                    <th>Flat No.</th>
                                    <th>Building Owner Name</th>
                                    <th>Building Owner Email</th>
                                    <th>Building Owner Phone No.</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $query  = "SELECT tbl_tenant.*,tbl_owner.* FROM tbl_tenant INNER JOIN tbl_owner ON tbl_tenant.owner_id=tbl_owner.owner_id WHERE tbl_tenant.ban='1' ORDER BY tenant_id DESC";
                                $result = mysqli_query($con, $query);
                                if($result){
                                    $i=1;
                                    $count = mysqli_num_rows($result);
                                    if($count>0){
                                        while ($row = mysqli_fetch_array($result)) {
                                ?>
                                            
                                
                                <tr>
                                    <td></td>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $row['tenant_name'];?></td>
                                    <td><img src="../<?php echo $row['tenant_photo'];?>" alt="Tenant Photo" style="width:100px;height: 100px;"/></td>                                   
                                    <td><?php echo $row['tenant_email'];?></td>
                                    <td><?php echo $row['tenant_phone'];?></td>
                                    <td><?php echo $row['tenant_nid_num'];?></td>
                                    <td><?php echo $row['building_name'];?></td>
                                    <td><?php echo $row['floor_num'];?></td>
                                    <td><?php echo $row['flat_num'];?></td>
                                    <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td>
                                        <a href="view-tenant-details.php?view_tenant_id=<?php echo $row['tenant_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                            <button class="btn btn-primary btn-xs" data-title="View" >
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>
                                        </a>

                                        <a href="?unban_tenant_id=<?php echo $row['tenant_id'];?>" onclick="return confirm('Are you sure to unban this tenant?');" data-placement="top" data-toggle="tooltip" title="Unban">
                                            <button class="btn btn-success btn-xs" data-title="Unban">
                                                <span class="glyphicon glyphicon-thumbs-up"></span>
                                            </button>
                                        </a>

                                        <a href="?delete_tenant_id=<?php echo $row['tenant_id'];?>" onclick="return confirm('Are you sure to delete this tenant?');" data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>   
                                <?php
                                        }
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
    <!--Main Body Content Section End--> 
<?php include 'inc/footer.php';?>	