<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
    <div class="main-bar">
        <h3>
            <i class="fa fa-columns"></i>&nbsp; 
        </h3>
    </div>
    <!--In Which Page We Are Name Section End-->

<?php include 'inc/sidebar.php';?>
    
    <!--Main Body Content Section Start-->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">                                              
                <div class="row">
                    <div class="col-md-12 text-align-left"   style="margin-top:50px;margin-bottom: 50px;">
                    <?php
                        if(isset($_POST['ok'])){
                            echo "<script>window.location = 'index.php';</script>";
                        }
                        ?>
                        <?php
                        if(isset($_GET['view_sale_ads_id'])){
                            $sale_id = mysqli_real_escape_string($con,$_GET['view_sale_ads_id']);
                            $query = "SELECT tbl_flat_sell_ads.*, tbl_owner.* FROM tbl_flat_sell_ads INNER JOIN tbl_owner ON tbl_flat_sell_ads.owner_id = tbl_owner.owner_id WHERE tbl_flat_sell_ads.id='$sale_id'";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)){
                        ?>
                    
                        <form class="form-horizontal" action="" method="POST">
                            <div  class="form-group">
                                <label class="col-md-3 control-label">Apartment Image</label> 
                                <div class="col-md-4" id="nid-photo">
                                    <img src="../<?php echo $row['flat_image'];?>" alt="flat image" style="max-width:300px;max-height: 350px;" />                     
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Building Name</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="<?php echo $row['building_name'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Name</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="<?php echo $row['firstname']." ".$row['lastname'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Email</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="<?php echo $row['email'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Email</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="+880<?php echo $row['phone'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-8">
                                    <input id="floor_num" name="floor_num" type="number" value="<?php echo $row['floor_num'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>               


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-8">
                                    <input id="flat_num" name="flat_num" type="text" value="<?php echo $row['flat_num'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>                      


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bedroom">Total Bed Room</label>  
                                <div class="col-md-8">
                                    <input id="total_bedroom" name="total_bedroom" value="<?php echo $row['total_bedroom'];?>" type="number" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bedroom_size">Bed Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="bedroom_size" name="bedroom_size" type="text" value="<?php echo $row['bedroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_livingroom">Total Living Room</label>  
                                <div class="col-md-8">
                                    <input id="total_livingroom" name="total_livingroom" type="number" value="<?php echo $row['total_livingroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="livingroom_size">Living Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="livingroom_size" name="livingroom_size" type="text" value="<?php echo $row['livingroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bathroom">Total Bath Room</label>  
                                <div class="col-md-8">
                                    <input id="total_bathroom" name="total_bathroom" type="number" value="<?php echo $row['total_bathroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bathroom_size">Bath Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="bathroom_size" name="bathroom_size" type="text" value="<?php echo $row['bathroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_kitchenroom">Total Kitchen Room</label>  
                                <div class="col-md-8">
                                    <input id="total_kitchenroom" name="total_kitchenroom" type="number" value="<?php echo $row['total_kitchenroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kitchenroom_size">Kitchen Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="kitchenroom_size" name="kitchenroom_size" type="text" value="<?php echo $row['kitchenroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="price">Price(Tk)</label>  
                                <div class="col-md-8">
                                    <input id="price" name="price" type="text" value="<?php echo number_format($row['price'],2);?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>  
                                <div class="col-md-8">
                                    <textarea name="address" class="form-control" readonly><?php echo $row['building_address'];?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>  
                                <div class="col-md-8">
                                    <textarea name="description" class="form-control tinymce" readonly><?php echo $row['description'];?></textarea>
                                </div>
                            </div>                               

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button type="submit" name="ok" class="btn btn-primary">OK</button>            
                                </div>
                            </div>
                        </form>
                        <?php
                                }
                            }
                        } elseif (isset($_GET['view_rent_ads_id'])) {
                            $rent_id = mysqli_real_escape_string($con,$_GET['view_rent_ads_id']);
                            $query = "SELECT tbl_flat_rent_ads.*, tbl_owner.* FROM tbl_flat_rent_ads INNER JOIN tbl_owner ON tbl_flat_rent_ads.owner_id = tbl_owner.owner_id WHERE tbl_flat_rent_ads.id='$rent_id'";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while ($row = mysqli_fetch_array($result)){
                        ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            
                            <div  class="form-group">
                                <label class="col-md-3 control-label">Apartment Image</label> 
                                <div class="col-md-4" id="nid-photo">
                                    <img src="../<?php echo $row['flat_image'];?>" id="output_image" style="max-width:300px;max-height: 350px;"/>                     
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="rent_building_name">Building Name</label>  
                                <div class="col-md-8">
                                    <input id="rent_building_name" name="rent_building_name" type="text" value="<?php echo $row['rent_building_name'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Name</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="<?php echo $row['firstname']." ".$row['lastname'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Email</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="<?php echo $row['email'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buildingName">Owner Email</label>  
                                <div class="col-md-8">
                                    <input id="buildingName" name="building_name" type="text" value="+880<?php echo $row['phone'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="floor_num">Floor No.</label>  
                                <div class="col-md-8">
                                    <input id="floor_num" name="rent_floor_num" type="number" value="<?php echo $row['rent_floor_num'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>               


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="flat_num">Flat No.</label>  
                                <div class="col-md-8">
                                    <input id="flat_num" name="rent_flat_num" type="text" value="<?php echo $row['rent_flat_num'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>                      

                            <div class="form-group">
                                <label class="col-md-3 control-label">Available From</label>  
                                <div class="col-md-8">
                                    <select name="available" class="form-control" readonly>
                                        <option value="JANUARY"<?php if($row['available']=="JANUARY") echo 'selected="selected"'; ?>>January</option>
                                        <option value="FEBRUARY"<?php if($row['available']=="FEBRUARY") echo 'selected="selected"'; ?>>February</option>
                                        <option value="MARCH"<?php if($row['available']=="MARCH") echo 'selected="selected"'; ?>>March</option>
                                        <option value="APRIL"<?php if($row['available']=="APRIL") echo 'selected="selected"'; ?>>April</option>
                                        <option value="MAY"<?php if($row['available']=="MAY") echo 'selected="selected"'; ?>>May</option>
                                        <option value="JUNE"<?php if($row['available']=="JUNE") echo 'selected="selected"'; ?>>June</option>
                                        <option value="JULY"<?php if($row['available']=="JULY") echo 'selected="selected"'; ?>>July</option>
                                        <option value="AUGUST"<?php if($row['available']=="AUGUST") echo 'selected="selected"'; ?>>August</option>
                                        <option value="SEPTEMBER"<?php if($row['available']=="SEPTEMBER") echo 'selected="selected"'; ?>>September</option>
                                        <option value="OCTOBER"<?php if($row['available']=="OCTOBER") echo 'selected="selected"'; ?>>October</option>
                                        <option value="NOVEMBER"<?php if($row['available']=="NOVEMBER") echo 'selected="selected"'; ?>>November</option>
                                        <option value="DECEMBER"<?php if($row['available']=="DECEMBER") echo 'selected="selected"'; ?>>December</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bedroom">Total Bed Room</label>  
                                <div class="col-md-8">
                                    <input id="total_bedroom" name="total_bedroom" value="<?php echo $row['total_bedroom'];?>" type="number" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bedroom_size">Bed Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="bedroom_size" name="bedroom_size" type="text" value="<?php echo $row['bedroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_livingroom">Total Living Room</label>  
                                <div class="col-md-8">
                                    <input id="total_livingroom" name="total_livingroom" type="number" value="<?php echo $row['total_livingroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="livingroom_size">Living Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="livingroom_size" name="livingroom_size" type="text" value="<?php echo $row['livingroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_bathroom">Total Bath Room</label>  
                                <div class="col-md-8">
                                    <input id="total_bathroom" name="total_bathroom" type="number" value="<?php echo $row['total_bathroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bathroom_size">Bath Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="bathroom_size" name="bathroom_size" type="text" value="<?php echo $row['bathroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="total_kitchenroom">Total Kitchen Room</label>  
                                <div class="col-md-8">
                                    <input id="total_kitchenroom" name="total_kitchenroom" type="number" value="<?php echo $row['total_kitchenroom'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kitchenroom_size">Kitchen Room Size(sqrt ft.)</label>  
                                <div class="col-md-8">
                                    <input id="kitchenroom_size" name="kitchenroom_size" type="text" value="<?php echo $row['kitchenroom_size'];?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="rent_per_month">Rent Per Month(Tk)</label>  
                                <div class="col-md-8">
                                    <input id="rent_per_month" name="rent_per_month" type="text" value="<?php echo number_format($row['rent_per_month'],2);?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="advance_payment">Advance Payment(Tk)</label>  
                                <div class="col-md-8">
                                    <input id="advance_payment" name="advance_payment" type="text" value="<?php echo number_format($row['advance_payment'],2);?>" class="form-control input-md" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>  
                                <div class="col-md-8">
                                    <textarea name="building_address" class="form-control" readonly><?php echo $row['building_address'];?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Description/Condition</label>  
                                <div class="col-md-8">
                                    <textarea name="description" class="form-control tinymce" readonly><?php echo $row['description'];?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button type="submit" name="ok" class="btn btn-primary">OK</button>            
                                </div>
                            </div>
                        </form>
                        <?php
                                }
                            }
                        }else{
                            echo "<script>window.location = '404.php';</script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main Body Content Section End--> 
<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b8jn5oxw2wsq20pm7uc2nnu56ea992nztzxossmob6lhj56j'></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 200,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [


        ]
    });
</script>
<?php include 'inc/footer.php';?>