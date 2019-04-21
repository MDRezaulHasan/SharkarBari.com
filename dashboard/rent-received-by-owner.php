<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-usd"></i>&nbsp; Rent Received By Owner
        </h3>
    </div>
    <!--In Which Page We Are Name Section End-->
    
<?php include 'inc/sidebar.php';?>
            
    <!--Main Body Content Section Start-->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">                                              
                <div class="row">
                    <div class="col-md-12"   style="margin:30px auto 0 auto;">
                        <a href="">
                            <button type="submit" name="delect_selected" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete All Selected</button>
                        </a>
                    </div>
                    <div class="col-md-12"   style="margin-top:50px;margin-bottom: 50px;">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><input type="checkbox" id="checkall" /></th>
                                    <th>SL</th>
                                    <th>Owner Name</th>
                                    <th>Email</th>
                                    <th>Building Name</th>
                                    <th>Floor No.</th>   
                                    <th>Flat No.</th>
                                    <th>Amount Received(Tk)</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php                                 
                                $query  = "SELECT tbl_owner_rent_received.*,tbl_owner.* FROM tbl_owner_rent_received INNER JOIN tbl_owner ON tbl_owner_rent_received.owner_id=tbl_owner.owner_id ORDER BY rent_received_id DESC";
                                $result = mysqli_query($con, $query);
                                if($result){
                                    $i=1;
                                    $count = mysqli_num_rows($result);
                                    if($count>0){
                                        while ($row = mysqli_fetch_array($result)) {
                                ?>
                                            
                                
                                <tr>
                                    <td></td>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['building_name'];?></td>
                                    <td><?php echo $row['floor_num'];?></td>
                                    <td><?php echo $row['flat_num'];?></td>
                                    <td><?php echo number_format($row['rent_amount_received'],2);?></td>
                                    <td><?php echo dateFormat($row['date']);?></td>
                                    <td>
                                        <a href="?del_rent_id=<?php echo $row['rent_received_id'];?>" onclick="return confirm('Are you sure to delete this msg?');" data-placement="top" data-toggle="tooltip" title="Delete">
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

