<?php 
session_start();

include 'database/db_connection.php';
include 'helpers/function.php';
global $con;
if(isset($_GET['search'])){
    $area_name = mysqli_real_escape_string($con,$_GET['area_name']);
    $property_for = mysqli_real_escape_string($con,$_GET['property_for']);
    $min = mysqli_real_escape_string($con,$_GET['min']);
    $max = mysqli_real_escape_string($con,$_GET['max']);
}else{
    header("Location:404.php");
}

include'include/header.php';
?>


    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
          <span class="pull-right"><a href="#">Home</a> / Search Result</span>
          <h2>Search Result</h2>
        </div>
    </div>
    <!-- banner -->
    
   <div class="container">
        <div class="properties-listing spacer">
            <div class="row">
                <?php
                if ($property_for == 'rent') {
                    $query  = "SELECT * FROM tbl_flat_rent_ads WHERE building_address LIKE '%$area_name%' AND property_for='$property_for' AND rent_per_month BETWEEN '$min' AND '$max'";
                    $result = mysqli_query($con,$query);
                    if($result){
                        $count_query = mysqli_num_rows($result);
                        if ($count_query>0) {

                            while ($row = mysqli_fetch_array($result)){      
                    ?>                            
                                <div class="col-lg-3 col-sm-6">
                                    <div class="properties">
                                        <div class="image-holder">
                                            <a href="property-detail.php?flat_rent_id=<?php echo $row['id'];?>">
                                                <img src="<?php echo $row['flat_image'];?>" class="img-responsive" alt="properties" style="height: 150px;width:100%;"/>
                                            </a>
                                            <?php
                                            if($row['booked'] == '1'){
                                            ?>
                                            <div class="status sold">Booked</div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <h4><a href="property-detail.php?flat_rent_id=<?php echo $row['id'];?>"><?php echo $row['rent_building_name'];?></a></h4>
                                        <p class="price">Rent Per Month: <?php echo number_format($row['rent_per_month'],2);?>Tk</p>
                                        <p class="price">Advance Payment: <?php echo number_format($row['advance_payment'],2);?>Tk</p>
                                        <?php
                                        if($row['booked'] == '0'){
                                        ?>
                                        <p class="price">Available From: <?php echo $row['available'];?></p>
                                        <?php
                                        }else{
                                        ?>
                                        <p class="price">Not Available</p>
                                        <?php
                                        }
                                        ?>
                                        <div class="listing-detail">
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row['total_bedroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row['total_livingroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room"><?php echo $row['total_bathroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen Room"><?php echo $row['total_kitchenroom'];?></span> 
                                        </div>
                                        <a class="btn btn-primary" href="property-detail.php?flat_rent_id=<?php echo $row['id'];?>">View Details</a>
                                    </div>
                                </div>
                <?php
                            }
                        } else{
                            echo '<h2 style="color:red;font-weight:bold;">No Data Found</h2>';
                        }
                    }
                } elseif ($property_for == 'sale') {
                    $query  = "SELECT * FROM tbl_flat_sell_ads WHERE building_address LIKE '%$area_name%' AND property_for='$property_for' AND price BETWEEN '$min' AND '$max'";
                    $result = mysqli_query($con,$query);
                    if($result){
                        $count_query = mysqli_num_rows($result);
                        if ($count_query>0) {

                            while ($row = mysqli_fetch_array($result)){      
                                   
                ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="properties">
                                        <div class="image-holder">
                                            <a href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>">
                                                <img src="<?php echo $row['flat_image'];?>" class="img-responsive" alt="properties" style="height: 150px;width:100%;"/>
                                            </a>
                                            <?php
                                            if($row['sold'] == '1'){
                                            ?>
                                            <div class="status sold">Sold</div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <h4><a href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>"><?php echo $row['building_name'];?></a></h4>
                                        <p class="price">Price: <?php echo number_format($row['price'],2);?>Tk</p>
                                        <div class="listing-detail">
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row['total_bedroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row['total_livingroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room"><?php echo $row['total_bathroom'];?></span> 
                                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen Room"><?php echo $row['total_kitchenroom'];?></span> 
                                        </div>
                                        <a class="btn btn-primary" href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>">View Details</a>
                                    </div>
                                </div>
                
                <?php
                            }
                        } else{
                            echo '<h2 style="color:red;font-weight:bold;">No Data Found</h2>';
                        }
                    }
                } 
                ?>
            </div>
        </div>
   </div>>


<?php include'include/footer.php';?>