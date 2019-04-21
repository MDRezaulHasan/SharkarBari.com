<?php 
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
include 'include/slider.php';


?>

<div class="banner-search">
    <div class="container"> 
        <!-- banner -->
        <h3>Buy & Rent</h3>
        <div class="searchbar">
            <div class="row">
                <div class="search-form">
                    <form action="search-result.php" method="GET">
                        <div class="col-lg-4">
                            <input type="text" name="area_name" class="form-control" placeholder="Search of Area">
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" name="property_for">
                                <option value="sale">Buy</option>
                                <option value="rent">Rent</option>
                            </select>
                        </div>                          
                        <div class="col-lg-2">
                            <input name="min" type="text"  class="form-control input-md" placeholder="min-price">
                        </div>
                        <div class="col-lg-2">
                            <input name="max" type="text"  class="form-control input-md" placeholder="max-proce">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" name="search" class="btn btn-primary">Find Now</button>
                        </div>
                    </form>

                </div>   
            </div>
        </div>
	  
   </div>
</div>
<!-- banner -->
<div class="container">
    <div class="properties-listing spacer"> <a href="buy.php" class="pull-right viewall">View All Listing</a>
        <h2>Flat For Sale</h2>
        <div id="owl-example" class="owl-carousel">
            <?php
            global $con;
            $query = "SELECT * FROM tbl_flat_sell_ads WHERE approved='Y' AND ban='N' ORDER BY id DESC";
            $result = mysqli_query($con, $query);
            if($result){
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="properties">
                        <div class="image-holder">
                            <a href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>">
                                <img src="<?php echo $row['flat_image'];?>" class="img-responsive" alt="properties" style="height: 150px;width: 100%;"/>
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
                        <?php
                        if($row['sold'] == '0'){
                        ?>
                        <p class="price">Price: <?php echo number_format($row['price'],2);?>Tk</p>
                        <?php
                        }else{
                        ?>
                        <p class="price">Price: <del><?php echo number_format($row['price'],2);?></del>Tk</p>
                        <?php } ?>
                        <div class="listing-detail">
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row['total_bedroom'];?></span> 
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row['total_livingroom'];?></span> 
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room"><?php echo $row['total_bathroom'];?></span> 
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen Room"><?php echo $row['total_kitchenroom'];?></span> 
                        </div>
                        <a class="btn btn-primary" href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>">View Details</a>
                    </div>
            <?php
                }
            }
            ?>
            
  
      
        </div>
    </div>   
</div>
<div class="container">
    <div class="properties-listing spacer"> <a href="rent.php" class="pull-right viewall">View All Listing</a>
        <h2>Flat For Rent</h2>
        <div class="row">
            <?php
            global $con;
            $query = "SELECT * FROM tbl_flat_rent_ads WHERE approved='Y' AND ban='N' ORDER BY id DESC LIMIT 4";
            $result = mysqli_query($con, $query);
            if($result){
                while ($row = mysqli_fetch_array($result)) {
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
                            
                            
                            <?php
                            if($row['booked'] == '0'){
                            ?>
                            <p class="price">Rent Per Month: <?php echo number_format($row['rent_per_month'],2);?>Tk</p>
                            <p class="price">Advance Payment: <?php echo number_format($row['advance_payment'],2);?>Tk</p>
                            <?php
                            }else{
                            ?>
                            <p class="price">Rent Per Month: <del><?php echo number_format($row['rent_per_month'],2);?></del>Tk</p>
                            <p class="price">Advance Payment: <del><?php echo number_format($row['advance_payment'],2);?></del>Tk</p>                                       
                            <?php
                            } 
                            ?>
                                
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
            }
            ?>
            
  
      
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>