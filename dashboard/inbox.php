<?php 
include 'inc/header.php';
global $con;


if(isset($_GET['seen_msg_id'])){
    $seen_msg_id = $_GET['seen_msg_id'];

    $update_query = "UPDATE tbl_contact_msg SET status='1' WHERE id='$seen_msg_id'";
    $run_update_query = mysqli_query($con, $update_query);
    if($run_update_query){
           echo "<script>alert('Message Sent Into Seen Box')</script>";
           echo "<script>window.open('inbox.php','_self')</script>";

        } else {
            echo "<script>alert('Error!')</script>";
            echo "<script>window.open('inbox.php','_self')</script>";
        }
}elseif(isset($_GET['del_msg_id'])){
    $del_msg_id = $_GET['del_msg_id'];

    $delquery = "DELETE FROM tbl_contact_msg WHERE id='$del_msg_id'";
    $del_msg= mysqli_query($con,$delquery);
    if($del_msg){
            echo "<script>alert('Message Deleted Successfully')</script>";
           echo "<script>window.open('inbox.php','_self')</script>";

    } else {
        echo "<script>alert('Message Not Deleted!')</script>";
        echo "<script>window.open('inbox.php','_self')</script>";
    }
}elseif(isset($_GET['unseen_msg_id'])){
    $unseen_msg_id = $_GET['unseen_msg_id'];

    $update_query = "UPDATE tbl_contact_msg SET status='0' WHERE id='$unseen_msg_id'";
    $run_update_query = mysqli_query($con, $update_query);
    if($run_update_query){
        echo "<script>alert('Message Sent Into Inbox Back')</script>";
        echo "<script>window.open('inbox.php','_self')</script>";

     } else {
         echo "<script>alert('Error!')</script>";
         echo "<script>window.open('inbox.php','_self')</script>";
     }
}


?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-user"></i>&nbsp; Inbox
        </h3>
    </div>
    <!--In Which Page We Are Name Section End-->

<?php include 'inc/sidebar.php';?>
            
    <!--Main Body Content Section Start-->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">                                              
                <div class="row">
                    <div class="col-md-12"   style="margin-top:50px;margin-bottom: 100px;">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                                $inbox_query = "SELECT * FROM tbl_contact_msg WHERE status='0' ORDER BY id DESC";
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
                                                <td><?php echo $inbx_row['fullname'];?></td>
                                                <td><?php echo $inbx_row['email'];?></td>
                                                <td><?php echo $inbx_row['phone_number'];?></td>
                                                <td><?php echo readMore($inbx_row['message'],100);?></td>
                                                <td><?php echo dateFormat($inbx_row['date']);?></td>

                                                <td>
                                                    <a href="msg-view.php?msg_view_id=<?php echo $inbx_row['id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view_msg" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                    </a>

                                                    <a href="msg-reply.php?reply_msg_id=<?php echo $inbx_row['id'];?>" data-placement="top" data-toggle="tooltip" title="Reply">
                                                        <button class="btn btn-default btn-xs" data-title="Reply" data-toggle="modal" data-target="#reply" style="background: #5cb85c;border-color: #4cae4c;color: white;">
                                                            <span class="glyphicon glyphicon-send"></span>
                                                        </button>
                                                    </a>
                                                    
                                                    <a href="?seen_msg_id=<?php echo $inbx_row['id'];?>" onclick="return confirm('Are you sure to move this msg to seen box?');" data-placement="top" data-toggle="tooltip" title="Seen">
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
                        
                        
                        <h3 style="background: #72b70f;padding: 10px;color: white;font-weight: bold;margin-top: 70px;">Seen Message</h3>
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
                                $seen_msg_query = "SELECT * FROM tbl_contact_msg WHERE status='1' ORDER BY id DESC";
                                $seen_msg_query_result  = mysqli_query($con, $seen_msg_query);
                                if($seen_msg_query_result){
                                    $i=1;
                                    $count = mysqli_num_rows($seen_msg_query_result);
                                    if($count>0){
                                         while ($seen_box_row = mysqli_fetch_array($seen_msg_query_result)) {
                                ?>
                        
                                            <tr>
                                                <td></td>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $seen_box_row['fullname'];?></td>
                                                <td><?php echo $seen_box_row['email'];?></td>
                                                <td><?php echo $seen_box_row['phone_number'];?></td>
                                                <td><?php echo readMore($seen_box_row['message'],100);?></td>
                                                <td><?php echo dateFormat($seen_box_row['date']);?></td>

                                                <td>
                                                    <a href="msg-view.php?msg_view_id=<?php echo $seen_box_row['id'];?>" data-placement="top" data-toggle="tooltip" title="View">
                                                        <button class="btn btn-default btn-xs" data-title="View" data-toggle="modal" data-target="#view-msg" style="background: #337ab7;border-color: #2e6da4;color: white;">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                    </a>
                                                    <a href="?del_msg_id=<?php echo $seen_box_row['id'];?>" onclick="return confirm('Are you sure to delete this msg?');" data-placement="top" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                    <a href="?unseen_msg_id=<?php echo $seen_box_row['id'];?>" onclick="return confirm('Are you sure to unseen this msg?');" data-placement="top" data-toggle="tooltip" title="Unseen">
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
            </div>
        </div>
    </div>
    <!--Main Body Content Section End-->
    
<?php include 'inc/footer.php';?>	