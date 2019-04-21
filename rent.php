<?php 
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="index.php">Home</a> / Rent</span>
            <h2>Rent</h2>
        </div>
    </div>
    <!-- banner -->


    <div class="container">
        <div class="properties-listing spacer">
            <div class="row">
                <div class="col-lg-3 col-sm-4 ">

                    <div class="search-form">
                        <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                        <form action="search-result.php" method="GET">
                            <input type="text" name="area_name" class="form-control" placeholder="Search of Area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" name="property_for">
                                        <option value="sale">Buy</option>
                                        <option value="rent">Rent</option>
                                    </select>
                                </div>                          
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input name="min" type="text"  class="form-control input-md" placeholder="min-price">
                                </div>
                                <div class="col-md-6">
                                    <input name="max" type="text"  class="form-control input-md" placeholder="max-price">
                                </div>
                            </div>
                            <button type="submit" name="search" class="btn btn-primary">Find Now</button>
                        </form>
                    </div>
                         
                    <div class="hot-properties hidden-xs">
                        <h4>Hot Properties</h4>
                        <?php
                        global $con;
                        $pquery = "SELECT * FROM tbl_flat_rent_ads WHERE approved='Y' AND booked='0' AND ban='N' ORDER BY id DESC LIMIT 5 ";
                        $presult = mysqli_query($con, $pquery);
                        if($presult){
                            while ($prow = mysqli_fetch_array($presult)) {
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                                <a href="property-detail.php?flat_rent_id=<?php echo $prow['id'];?>">
                                    <img src="<?php echo $prow['flat_image'];?>" class="img-responsive img-circle" alt="properties"/>
                                </a>
                            </div>
                            <div class="col-lg-8 col-sm-7">
                              <h5><a href="property-detail.php?flat_rent_id=<?php echo $prow['id'];?>"><?php echo $prow['rent_building_name'];?></a></h5>
                              <p class="price">Rent Per Month: <?php echo number_format($prow['rent_per_month'],2);?>Tk</p>
                              <p class="price">Advance Payment: <?php echo number_format($prow['advance_payment'],2);?>Tk</p>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                   </div>
                </div>

                <div class="col-lg-9 col-sm-8">
                    <div class="row">
                        <?php
                        global $con;

                        $per_page = 6;
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $start_from = ($page-1)*$per_page;
                        ?>
                        <!--pagination-->

                        <?php

                        $query  = "SELECT * FROM tbl_flat_rent_ads WHERE approved='Y' AND ban='N' ORDER BY id DESC LIMIT $start_from,$per_page ";
                        $result = mysqli_query($con,$query);
                        if($result){
                            while ($row = mysqli_fetch_array($result)){      
                        ?>                            
                                <div class="col-lg-4 col-sm-6">
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
                        ?>
                            <div class="col-lg-12">
                                <div class="center">
                                <?php
                                    $squery = "SELECT * FROM tbl_flat_rent_ads";
                                    $sresult = mysqli_query($con,$squery);
                                    $total_rows = mysqli_num_rows($sresult);
                                    $total_pages = ceil($total_rows/$per_page);
                                    echo "<ul class='pagination'><li><a href='rent.php?page=1'>".'First Page'."</a></li>";
                                    for($i=1;$i<=$total_pages;$i++){
                                        echo "<li><a href='rent.php?page=".$i."'>".$i."</a></li>";
                                    }
                                    echo "<li><a href='rent.php?page=$total_pages'>".'Last page'."</a></li></ul>";
                                ?>
                                </div>
                            </div><!--pagination-->
                        <?php
                        }else{
                            header("Location:404.php");
                        }
                        ?>


                        <!-- Pagination Section Start-->

                        <!-- Pagination Section End-->
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include'include/footer.php';?>

