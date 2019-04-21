<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-flag"></i>&nbsp; Tenant Notice To Owner
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
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Notice</th>
                                    <th>Date</th> 
                                    <th>Building Owner Name</th>
                                    <th>Building Name</th>
                                    <th>Floor No.</th>
                                    <th>Flat No.</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php                                 
                                $query  = "SELECT tbl_tenant_notice.*,tbl_owner.* FROM tbl_tenant_notice INNER JOIN tbl_owner ON tbl_tenant_notice.owner_id=tbl_owner.owner_id ORDER BY tenant_notice_id DESC";
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
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo readMore($row['notice'],100);?></td>
                                    <td><?php echo dateFormat($row['date']);?></td>
                                    <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                                    <td><?php echo $row['building_name'];?></td>
                                    <td><?php echo $row['floor_num'];?></td>
                                    <td><?php echo $row['flat_num'];?></td>
                                    
                                    <td>
                                        <a href="view-tenant-notice.php?view_tenant_notice_id=<?php echo $row['tenant_notice_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                            <button class="btn btn-primary btn-xs" data-title="View" >
                                                <span class="glyphicon glyphicon-eye-open"></span>
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

