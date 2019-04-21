<?php 
include 'inc/header.php';
global $con;
if(isset($_GET['ban_rent_ads_id'])){
    $ban_rent_ads_id = mysqli_real_escape_string($con,$_GET['ban_rent_ads_id']);
    
    $ban_rent_ads_query = "UPDATE tbl_flat_rent_ads SET ban='Y' WHERE id='$ban_rent_ads_id'";
    $ban_rent_ads = mysqli_query($con, $ban_rent_ads_query);
    if($ban_rent_ads){
        echo "<script>alert('This Ads is Banned!')</script>";
        echo "<script>window.open('approved-rent-ads.php','_self')</script>";
    }else{
        echo "<script>alert('This Ads is not Banned!')</script>";
        echo "<script>window.open('approved-rent-ads.php','_self')</script>";
    }
} elseif (isset($_GET['delete_rent_ads_id'])) {
    $delete_rent_ads_id = mysqli_real_escape_string($con,$_GET['delete_rent_ads_id']);    
    
    $delete_rent_ads_query = "DELETE FROM tbl_flat_rent_ads WHERE id='$delete_rent_ads_id'";
    $delete_rent_ads = mysqli_query($con, $delete_rent_ads_query);
    if($delete_rent_ads){
        echo "<script>alert('This Ads is Deleted!')</script>";
        echo "<script>window.open('approved-rent-ads.php','_self')</script>";
    }else{
        echo "<script>alert('This Ads is not Delete!')</script>";
        echo "<script>window.open('approved-rent-ads.php','_self')</script>";
    }
}
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-check-circle"></i>&nbsp; Approved Rent Ads List
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
                                    <th>Sl No.</th>
                                    <th>Owner Email</th>
                                    <th>Owner Contact</th>
                                    <th>Building Name</th>
                                    <th>Floor Num.</th>
                                    <th>Flat No.</th>
                                    <th>Flat Image</th>
                                    <th>Rent(Tk)</th>
                                    <th>Advance Payment(Tk)</th>
                                    <th>Building Add.</th>
                                    <th>Description</th>                                   
                                    <th>Date</th>
                                    <th>Available From</th>
                                    <th>Action</th> 

                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $query  = "SELECT tbl_flat_rent_ads.*, tbl_owner.* FROM tbl_flat_rent_ads INNER JOIN tbl_owner ON tbl_flat_rent_ads.owner_id = tbl_owner.owner_id WHERE tbl_flat_rent_ads.approved='Y' AND tbl_flat_rent_ads.ban='N' ORDER BY tbl_flat_rent_ads.id DESC";
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
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['rent_building_name'];?></td>
                                    <td><?php echo $row['rent_floor_num'];?></td>
                                    <td><?php echo $row['rent_flat_num'];?></td>
                                    <td><img src="../<?php echo $row['flat_image'];?>" alt="owner image"/></td>
                                    <td><?php echo number_format($row['rent_per_month'],2);?></td>
                                    <td><?php echo number_format($row['advance_payment'],2);?></td>
                                    <td><?php echo $row['building_address'];?></td>
                                    <td><?php echo readMore($row['description'],100);?></td>
                                    <td><?php echo dateFormat($row['date']);?></td>
                                    <td><?php echo $row['available'];?></td>
                                    <td>
                                        <a href="view-ads-details.php?view_rent_ads_id=<?php echo $row['id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                            <button class="btn btn-primary btn-xs" data-title="View" >
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>
                                        </a>

                                        <a href="?ban_rent_ads_id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure to ban this Ads?');" data-placement="top" data-toggle="tooltip" title="Ban">
                                            <button class="btn btn-warning btn-xs" data-title="Ban">
                                                <span class="glyphicon glyphicon-ban-circle"></span>
                                            </button>
                                        </a>

                                        <a href="?delete_rent_ads_id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure to delete this Ads?');" data-placement="top" data-toggle="tooltip" title="Delete">
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