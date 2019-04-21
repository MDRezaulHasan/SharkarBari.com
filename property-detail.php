<?php 
session_start();

if(isset($_GET['flat_sale_id'])){
    $flat_sale_id = $_GET['flat_sale_id'];
}elseif (isset($_GET['flat_rent_id'])) {
    $flat_rent_id = $_GET['flat_rent_id'];
}else{
    header("Location:index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';

include'include/header.php';
?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <?php
            if(isset($_GET['flat_sale_id'])){
            ?>
            <span class="pull-right"><a href="#">Home</a> / Buy</span>
            <h2>Buy</h2>
            <?php
            } elseif (isset($_GET['flat_rent_id'])) {
            ?>
            <span class="pull-right"><a href="#">Home</a> / Rent</span>
            <h2>Rent</h2>
            <?php    
            }                   
            ?>
            
        </div>
    </div>
    <!-- banner -->


    <div class="container">
        <div class="properties-listing spacer">

            <div class="row">
                <div class="col-lg-3 col-sm-4 hidden-xs">

                    <div class="hot-properties hidden-xs">
                        <h4>Recent Properties</h4>
                        <?php
                        if(isset($_GET['flat_sale_id'])){
                            global $con;
                            $query = "SELECT * FROM tbl_flat_sell_ads WHERE approved='Y' AND sold='0' AND ban='N' ORDER BY id DESC LIMIT 5";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                                <a href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>">
                                    <img src="<?php echo $row['flat_image'];?>" class="img-responsive img-circle" alt="properties"/>
                                </a>
                            </div>
                            <div class="col-lg-8 col-sm-7">
                              <h5><a href="property-detail.php?flat_sale_id=<?php echo $row['id'];?>"><?php echo $row['building_name'];?></a></h5>
                              <p class="price">Price: <?php echo number_format($row['price'],2);?>Tk</p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        }elseif (isset($_GET['flat_rent_id'])) {
                            global $con;
                            $query = "SELECT * FROM tbl_flat_rent_ads WHERE approved='Y' AND booked='0' AND ban='N' ORDER BY id DESC LIMIT 5";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)) {                        
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                                <a href="property-detail.php?flat_rent_id=<?php echo $row['id'];?>">
                                    <img src="<?php echo $row['flat_image'];?>" class="img-responsive img-circle" alt="properties"/>
                                </a>
                            </div>
                            <div class="col-lg-8 col-sm-7">
                                <h5><a href="property-detail.php?flat_rent_id=<?php echo $row['id'];?>"><?php echo $row['rent_building_name'];?></a></h5>
                                <p class="price">Rent Per Month: <?php echo number_format($row['rent_per_month'],2);?>Tk</p>
                                <p class="price">Advance Payment: <?php echo number_format($row['advance_payment'],2);?>Tk</p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        }
                        ?>

                    </div>

                    <div class="advertisement">
                        <h4>Advertisements</h4>
                        <img src="images/advertisements.jpg" class="img-responsive" alt="advertisement">

                    </div>

                </div>

                <div class="col-lg-9 col-sm-8 ">
                    <?php
                    if(isset($_GET['flat_sale_id'])){
                        global $con;
                        $select_query = "SELECT tbl_flat_sell_ads.*, tbl_owner.* FROM tbl_flat_sell_ads INNER JOIN tbl_owner ON tbl_flat_sell_ads.owner_id = tbl_owner.owner_id WHERE id='$flat_sale_id'";
                        $run_query    = mysqli_query($con, $select_query);
                        if($run_query){
                            while ($value = mysqli_fetch_array($run_query)) {
                    ?>
                    
                    
                    <h2><?php echo $value['total_bedroom'];?> bedroom, <?php echo $value['total_livingroom'];?> living room, <?php echo $value['total_bathroom'];?> bathroom and <?php echo $value['total_kitchenroom'];?> kitchen flat</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="property-images">
                                <!-- Slider Starts -->
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators hidden-xs">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <!--<li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                        <li data-target="#myCarousel" data-slide-to="3" class=""></li>-->
                                    </ol>
                                    <div class="carousel-inner">
                                        <!-- Item 1 -->
                                        <div class="item active">
                                            <img src="<?php echo $value['flat_image'];?>" class="properties" alt="properties" />
                                        </div>
                                        <!-- #Item 1 -->

                                        <!-- Item 2 --
                                        <div class="item">
                                            <img src="images/properties/2.jpg" class="properties" alt="properties" />        
                                        </div>
                                        <!-- #Item 2 --

                                        <!-- Item 3 --
                                        <div class="item">
                                            <img src="images/properties/1.jpg" class="properties" alt="properties" />
                                        </div>
                                        <!-- #Item 3 --

                                        <!-- Item 4 --
                                        <div class="item ">
                                            <img src="images/properties/3.jpg" class="properties" alt="properties" />          
                                        </div>
                                        <!-- # Item 4 -->
                                        <?php
                                        if($value['sold'] == '1'){
                                        ?>
                                            <div class="status sold" style="font-size: 50px;text-align: center;height: 100px;padding: 40px ;position: absolute;top: 40%;left: 0;width: 100%;color: white;">
                                            Sold
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <!-- #Slider Ends -->

                            </div>

                            <div class="spacer">
                                <h3><span class="glyphicon glyphicon-th-list"></span> Properties Detail</h3>
                                <h5>
                                    <strong>Building Name: </strong><?php echo $value['building_name'];?>
                                    <br/><br/>
                                    <strong>Floor Number: </strong><?php echo $value['floor_num'];?>
                                    <br/><br/>
                                    <strong>Flat Number: </strong><?php echo $value['flat_num'];?>
                                    <br/><br/>                                   
                                    <strong>Bedroom Size(Sqr. ft.): </strong><?php echo $value['bedroom_size'];?>
                                    <br/><br/>
                                    <strong>Living room Size(Sqr. ft.): </strong><?php echo $value['livingroom_size'];?>
                                    <br/><br/>
                                    <strong>Bathroom Size(Sqr. ft.): </strong><?php echo $value['bathroom_size'];?>
                                    <br/><br/>
                                    <strong>Kitchen room Size(Sqr. ft.): </strong><?php echo $value['kitchenroom_size'];?>
                                </h5>
                                <br/>
                                <?php echo $value['description'];?>
                            </div>
                            <div>
                                <h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
                                <div class="well">
                                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $value['area_name'].',+'.$value['city'].',+'.$value['country'];?>&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $value['area_name'].',+'.$value['city'].',+'.$value['country'];?>&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                                </div> 
                            </div>  
                        </div>

                        <div class="col-lg-4"> 
                            <div class="col-lg-12  col-sm-6">
                                <div class="property-info">
                                    <p class="price" style="font-size: 17px;">
                                        <span style="color: black;">Price: </span> 
                                        <?php
                                        if($value['sold'] == '1'){
                                        ?>
                                        <span><del><?php echo number_format($value['price'],2);?>Tk</del></span>
                                        <?php
                                        }else{
                                        ?>
                                        <span><?php echo number_format($value['price'],2);?>Tk</span>
                                        <?php
                                        }
                                        ?>
                                    </p>
                                    <p class="area"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $value['building_address'];?></p> 

                                    <div class="profile">
                                        <span class="glyphicon glyphicon-user"></span> Owner Details
                                        <p><?php echo $value['firstname']." ".$value['lastname'];?><br> +880<?php echo $value['phone'];?><br><?php echo $value['email'];?></p>
                                    </div>
                                </div>

                                <h6><span class="glyphicon glyphicon-home"></span> Availability</h6>
                                <div class="listing-detail">
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $value['total_bedroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $value['total_livingroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room"><?php echo $value['total_bathroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen Room"><?php echo $value['total_kitchenroom'];?></span> 
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 ">
                                <?php
                                if (!isset($_SESSION['email']) == true) {
                                ?>
                                                               
                                <div class="enquiry">
                                    <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry To Owner</h6>
                                    <?php
                                        if(isset($_POST['send_message'])){
                                            global $con;

                                            $owner_email = validate($value['email']);
                                            $owner_email = mysqli_real_escape_string($con,$owner_email);

                                            $customer_name = validate($_POST['customer_name']);
                                            $customer_name = mysqli_real_escape_string($con,$customer_name);

                                            $customer_email = validate($_POST['customer_email']);
                                            $customer_email = mysqli_real_escape_string($con,$customer_email);

                                            $customer_phone_num = validate($_POST['customer_phone_num']);
                                            $customer_phone_num = mysqli_real_escape_string($con,$customer_phone_num);

                                            $customer_message = validate($_POST['customer_message']);
                                            $customer_message = mysqli_real_escape_string($con,$customer_message);

                                            if(empty($owner_email) || empty($customer_name) || empty($customer_email) || empty($customer_phone_num) || empty($customer_message)){
                                                $msg = "<div class='alert alert-danger'>
                                                            <button class='close' data-dismiss='alert'>&times;</button>
                                                            <strong>Warning!</strong> Input Field Must Not Be Empty.
                                                        </div>";
                                            }elseif (!filter_var($customer_email,FILTER_VALIDATE_EMAIL)) {
                                                $msg = "<div class='alert alert-danger'>
                                                            <button class='close' data-dismiss='alert'>&times;</button>
                                                            <strong>Error!</strong> Invalid Email Address.
                                                        </div>";
                                            }else{
                                                $message_query = "INSERT INTO customer_message(customer_name,customer_email,customer_phone_num,customer_message,owner_email) VALUES('$customer_name','$customer_email','$customer_phone_num','$customer_message','$owner_email')";
                                                $send_message  = mysqli_query($con,$message_query);
                                                if($send_message){
                                                    $msg = "<div class='alert alert-success'>
                                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                                <strong>Success!</strong>  Your Message Sent Successfully.  
                                                            </div>";
                                                }else{
                                                    $msg = "<div class='alert alert-danger'>
                                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                                <strong>Error!</strong>  Your Message Not Sent.  
                                                            </div>";
                                                }
                                            }

                                            
                                        }
                                    ?>
                                    <?php
                                    if(isset($msg))
                                    {
                                        echo $msg;               
                                    }
                                    ?>
                                    <form role="form" action="" method="post">
                                        <input type="text" name="customer_name" class="form-control" placeholder="Enter Your Full Name"/>
                                        <input type="email" name="customer_email" class="form-control" placeholder="Enter Your Email"/>
                                        <input type="number" name="customer_phone_num" class="form-control" placeholder="Enter Your Phone Number"/>
                                        <textarea rows="6" name="customer_message" class="form-control" placeholder="Enter Whats on your mind?"></textarea>
                                        <!--<input type="text" name="owner_email" class="form-control" placeholder="Enter Property Owner Email"/>-->
                                        <button type="submit" class="btn btn-primary" name="send_message">Send Message</button>
                                    </form>
                                </div>  
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    }elseif(isset($_GET['flat_rent_id'])){
                        global $con;
                        $select_query = "SELECT tbl_flat_rent_ads.*, tbl_owner.* FROM tbl_flat_rent_ads INNER JOIN tbl_owner ON tbl_flat_rent_ads.owner_id = tbl_owner.owner_id WHERE id='$flat_rent_id'";
                        $run_query    = mysqli_query($con, $select_query);
                        if($run_query){
                            while ($value = mysqli_fetch_array($run_query)) {
                    ?>
                    
                    
                    <h2><?php echo $value['total_bedroom'];?> bedroom, <?php echo $value['total_livingroom'];?> living room, <?php echo $value['total_bathroom'];?> bathroom and <?php echo $value['total_kitchenroom'];?> kitchen flat</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="property-images">
                                <!-- Slider Starts -->
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators hidden-xs">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <!--<li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                        <li data-target="#myCarousel" data-slide-to="3" class=""></li>-->
                                    </ol>
                                    <div class="carousel-inner">
                                        <!-- Item 1 -->
                                        <div class="item active">
                                            <img src="<?php echo $value['flat_image'];?>" class="properties" alt="properties" />
                                        </div>
                                        <!-- #Item 1 -->

                                        <!-- Item 2 --
                                        <div class="item">
                                            <img src="images/properties/2.jpg" class="properties" alt="properties" />        
                                        </div>
                                        <!-- #Item 2 --

                                        <!-- Item 3 --
                                        <div class="item">
                                            <img src="images/properties/1.jpg" class="properties" alt="properties" />
                                        </div>
                                        <!-- #Item 3 --

                                        <!-- Item 4 --
                                        <div class="item ">
                                            <img src="images/properties/3.jpg" class="properties" alt="properties" />          
                                        </div>
                                        <!-- # Item 4 -->
                                        <?php
                                        if($value['booked'] == '1'){
                                        ?>
                                        <div class="status sold" style="font-size: 50px;text-align: center;height: 100px;padding: 40px ;position: absolute;top: 42%;left: 0;width: 100%;color: white;">
                                            BOOKED
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <!-- #Slider Ends -->

                            </div>

                            <div class="spacer">
                                <h3><span class="glyphicon glyphicon-th-list"></span> Properties Detail</h3>
                                <h5>
                                    <strong>Building Name: </strong><?php echo $value['rent_building_name'];?>
                                    <br/><br/>
                                    <strong>Floor Number: </strong><?php echo $value['rent_floor_num'];?>
                                    <br/><br/>
                                    <strong>Flat Number: </strong><?php echo $value['rent_flat_num'];?>
                                    <br/><br/>
                                    <strong>Available From: </strong><?php if($value['booked'] == '0'){ echo $value['available'];}else{ echo 'Not Available';}?>
                                    <br/><br/>
                                    <strong>Bedroom Size(Sqr. ft.): </strong><?php echo $value['bedroom_size'];?>
                                    <br/><br/>
                                    <strong>Living room Size(Sqr. ft.): </strong><?php echo $value['livingroom_size'];?>
                                    <br/><br/>
                                    <strong>Bathroom Size(Sqr. ft.): </strong><?php echo $value['bathroom_size'];?>
                                    <br/><br/>
                                    <strong>Kitchen room Size(Sqr. ft.): </strong><?php echo $value['kitchenroom_size'];?>
                                    <br/><br/>
                                    <strong>Monthly Rent: </strong><?php echo number_format($value['rent_per_month'],2);?>Tk
                                    <br/><br/>
                                    <strong>Advance Payment: </strong><?php echo number_format($value['advance_payment'],2);?>Tk
                                </h5>
                                <br/>
                                <?php echo $value['description'];?>
                            </div>
                            <div>
                                <h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
                                <div class="well">
                                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $value['area_name'].',+'.$value['city'].',+'.$value['country'];?>&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $value['area_name'].',+'.$value['city'].',+'.$value['country'];?>&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                                </div> 
                            </div>  
                        </div>

                        <div class="col-lg-4"> 
                            <div class="col-lg-12  col-sm-6">
                                <div class="property-info">
                                    
                                    <p class="price" style="font-size: 15px;">
                                        <span style="color: black;">Monthly Rent: </span>
                                        <?php
                                        if($value['booked'] == '1'){
                                        ?>
                                        <span><del><?php echo number_format($value['rent_per_month'],2);?>Tk</del></span>
                                        <?php
                                        }else{
                                        ?>
                                        <span><?php echo number_format($value['rent_per_month'],2);?>Tk</span>
                                        <?php
                                        }
                                        ?>
                                        
                                    </p>
                                    <p class="price" style="font-size: 15px;">
                                        <span style="color: black;">Advance Payment: </span>
                                        <?php
                                        if($value['booked'] == '1'){
                                        ?>
                                        <span><del><?php echo number_format($value['advance_payment'],2);?>Tk</del></span>
                                        <?php
                                        }else{
                                        ?>
                                        <span><?php echo number_format($value['advance_payment'],2);?>Tk</span>
                                        <?php
                                        }
                                        ?>
                                        
                                    </p>
                                    
                                    <p class="area"><span class="glyphicon glyphicon-map-marker"></span><span><?php echo $value['building_address'];?></span></p> 

                                    <div class="profile">
                                        <span class="glyphicon glyphicon-user"></span> Owner Details
                                        <p><?php echo $value['firstname']." ".$value['lastname'];?><br> +880<?php echo $value['phone'];?><br><?php echo $value['email'];?></p>
                                    </div>
                                </div>

                                <h6><span class="glyphicon glyphicon-home"></span> Availability</h6>
                                <div class="listing-detail">
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $value['total_bedroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $value['total_livingroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room"><?php echo $value['total_bathroom'];?></span> 
                                    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen Room"><?php echo $value['total_kitchenroom'];?></span> 
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 ">
                                <?php
                                if (!isset($_SESSION['email']) == true) {
                                ?>
                                <div class="enquiry">
                                    <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry To Owner</h6>
                                    <?php
                                    if(isset($_POST['send_message'])){
                                        global $con;
                                        
                                        $owner_email = validate($value['email']);
                                        $owner_email = mysqli_real_escape_string($con,$owner_email);
                                        
                                        $customer_name = validate($_POST['customer_name']);
                                        $customer_name = mysqli_real_escape_string($con,$customer_name);
                                        
                                        $customer_email = validate($_POST['customer_email']);
                                        $customer_email = mysqli_real_escape_string($con,$customer_email);
                                        
                                        $customer_phone_num = validate($_POST['customer_phone_num']);
                                        $customer_phone_num = mysqli_real_escape_string($con,$customer_phone_num);
                                        
                                        $customer_message = validate($_POST['customer_message']);
                                        $customer_message = mysqli_real_escape_string($con,$customer_message);
                                        
                                        if(empty($owner_email) || empty($customer_name) || empty($customer_email) || empty($customer_phone_num) || empty($customer_message)){
                                            $msg = "<div class='alert alert-danger'>
                                                        <button class='close' data-dismiss='alert'>&times;</button>
                                                        <strong>Warning!</strong> Input Field Must Not Be Empty.
                                                    </div>";
                                        }elseif (!filter_var($customer_email,FILTER_VALIDATE_EMAIL)) {
                                            $msg = "<div class='alert alert-danger'>
                                                        <button class='close' data-dismiss='alert'>&times;</button>
                                                        <strong>Error!</strong> Invalid Email Address.
                                                    </div>";
                                        }else{
                                            $message_query = "INSERT INTO customer_message(customer_name,customer_email,customer_phone_num,customer_message,owner_email) VALUES('$customer_name','$customer_email','$customer_phone_num','$customer_message','$owner_email')";
                                            $send_message  = mysqli_query($con,$message_query);
                                            if($send_message){
                                                $msg = "<div class='alert alert-success'>
                                                            <button class='close' data-dismiss='alert'>&times;</button>
                                                            <strong>Success!</strong>  Your Message Sent Successfully.  
                                                        </div>";
                                            }else{
                                                $msg = "<div class='alert alert-danger'>
                                                            <button class='close' data-dismiss='alert'>&times;</button>
                                                            <strong>Error!</strong>  Your Message Not Sent.  
                                                        </div>";
                                            }
                                        }
                                    
                                        
                                    }
                                    ?>
                                    <?php
                                    if(isset($msg))
                                    {
                                        echo $msg;               
                                    }
                                    ?>
                                    <form role="form" action="" method="post">
                                        <input type="text" name="customer_name" class="form-control" placeholder="Enter Your Full Name"/>
                                        <input type="email" name="customer_email" class="form-control" placeholder="Enter Your Email"/>
                                        <input type="number" name="customer_phone_num" class="form-control" placeholder="Enter Your Phone Number"/>
                                        <textarea rows="6" name="customer_message" class="form-control" placeholder="Enter Whats on your mind?"></textarea>
                                        <!--<input type="text" name="owner_email" class="form-control" placeholder="Enter Property Owner Email"/>-->
                                        <button type="submit" class="btn btn-primary" name="send_message">Send Message</button>
                                    </form>
                                </div> 
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include'include/footer.php';?>