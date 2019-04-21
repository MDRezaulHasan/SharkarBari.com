<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-user"></i>&nbsp; Customer TO Owner Message
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
                                    <th>Receiver (Owner Email)</th>
                                    <th>Customer Name</th>
                                    <th>Sender(Customer Email)</th>
                                    <th>Customer Phone No.</th>
                                    <th>Customer Message</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = "SELECT * FROM customer_message";
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
                                            <td><?php echo $row['owner_email'];?></td>
                                            <td><?php echo $row['customer_name'];?></td>
                                            <td><?php echo $row['customer_email'];?></td>
                                            <td><?php echo "+880".$row['customer_phone_num'];?></td>
                                            <td><?php echo readMore($row['customer_message'],100);?></td>
                                            <td><?php echo dateFormat($row['date']);?></td>
                                            <td>
                                            <a href="customer-msg-view.php?customer_msg_view_id=<?php echo $row['msg_id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view_msg" style="background: #337ab7;border-color: #2e6da4;color: white;">
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
