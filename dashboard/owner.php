<?php 
include 'inc/header.php';
global $con;
if(isset($_GET['ban_owner_id'])){
    $ban_owner_id = mysqli_real_escape_string($con,$_GET['ban_owner_id']);
    $ban_query = "UPDATE tbl_owner SET ban='1' WHERE owner_id='$ban_owner_id'";
    $ban_owner = mysqli_query($con, $ban_query);
    if($ban_owner){
        echo "<script>alert('This Owner is Banned!')</script>";
        echo "<script>window.open('owner.php','_self')</script>";
    }else{
        echo "<script>alert('This Owner is not Banned!')</script>";
        echo "<script>window.open('owner.php','_self')</script>";
    }
} elseif (isset($_GET['delete_owner_id'])) {
    $delete_owner_id = mysqli_real_escape_string($con,$_GET['delete_owner_id']);    
    
    $delete_query = "DELETE FROM tbl_owner WHERE owner_id='$delete_owner_id'";
    $delete_owner = mysqli_query($con, $delete_query);
    if($delete_owner){
        echo "<script>alert('This Owner is Deleted!')</script>";
        echo "<script>window.open('owner.php','_self')</script>";
    }else{
        echo "<script>alert('This Owner is not Delete!')</script>";
        echo "<script>window.open('owner.php','_self')</script>";
    }
}
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-user"></i>&nbsp; Owner's List
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
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Photo</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>NID No.</th>
                                    <th>NID Photo</th>                                   
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $query  = "SELECT * FROM tbl_owner WHERE ban='0' ORDER BY owner_id DESC";
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
                                    <td><?php echo $row['firstname'];?></td>
                                    <td><?php echo $row['lastname'];?></td>
                                    <td><img src="../<?php echo $row['profile_image'];?>" alt="owner image"/></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td><?php echo $row['nid_number'];?></td>
                                    <td><img src="../<?php echo $row['nid_image'];?>" alt="owner nid image"/></td>
                                    <td>
                                        <a href="view-owner-details.php?view_owner_id=<?php echo $row['owner_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                            <button class="btn btn-primary btn-xs" data-title="View" >
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>
                                        </a>

                                        <a href="?ban_owner_id=<?php echo $row['owner_id'];?>" onclick="return confirm('Are you sure to ban this owner?');" data-placement="top" data-toggle="tooltip" title="Ban">
                                            <button class="btn btn-warning btn-xs" data-title="Ban">
                                                <span class="glyphicon glyphicon-ban-circle"></span>
                                            </button>
                                        </a>

                                        <a href="?delete_owner_id=<?php echo $row['owner_id'];?>" onclick="return confirm('Are you sure to delete this owner?');" data-placement="top" data-toggle="tooltip" title="Delete">
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