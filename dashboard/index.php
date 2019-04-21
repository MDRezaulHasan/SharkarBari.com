<?php 
include 'inc/header.php';
global $con;
?>

    <!--In Which Page We Are Name Section Start-->
	<div class="main-bar">
            <h3>
                <i class="fa fa-home"></i>&nbsp; Home
            </h3>
	</div>
	<!--In Which Page We Are Name Section End-->
                               
<?php include 'inc/sidebar.php';?>
            
	<!--Main Body Content Section Start-->
	<div id="content">
		<div class="outer">
			<div class="inner bg-light lter">
				<div class="text-center">
					<ul class="stats_box">
						
						<li>										
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_owner_query     = "SELECT * FROM tbl_owner";
                                                        $total_owner_run_query = mysqli_query($con, $total_owner_query);
                                                        if($total_owner_run_query){
                                                            $total_owner = mysqli_num_rows($total_owner_run_query);
                                                        ?>
                                                        <i class=" fa fa-users fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_owner>0){
                                                                echo $total_owner;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>
                                                        </strong> 
                                                        <small>Total Owners</small>
                                                        <?php
                                                        }
                                                        ?>
                                                            
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_banned_owner_query     = "SELECT * FROM tbl_owner WHERE ban='1'";
                                                        $total_banned_owner_run_query = mysqli_query($con, $total_banned_owner_query);
                                                        if($total_banned_owner_run_query){
                                                            $total_banned_owner = mysqli_num_rows($total_banned_owner_run_query);
                                                        ?>
                                                        <i class=" fa fa-ban fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_banned_owner>0){
                                                                echo $total_banned_owner;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>                                                         
                                                        </strong> 
                                                        <small>Banned Owners</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>										
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_tenants_query     = "SELECT * FROM tbl_tenant";
                                                        $total_tenants = mysqli_query($con, $total_tenants_query);
                                                        if($total_tenants){
                                                            $total_tenants_count = mysqli_num_rows($total_tenants);
                                                        ?>
                                                        <i class=" fa fa-users fa-2x"></i> 	 
                                                        <strong>
                                                             <?php 
                                                            if($total_tenants_count>0){
                                                                echo $total_tenants_count;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>
                                                        </strong> 
                                                        <small>Total Tenants</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_banned_tenant_query     = "SELECT * FROM tbl_tenant WHERE ban='1'";
                                                        $total_banned_tenant_run_query = mysqli_query($con, $total_banned_tenant_query);
                                                        if($total_banned_tenant_run_query){
                                                            $total_banned_tenant = mysqli_num_rows($total_banned_tenant_run_query);
                                                        ?>
                                                        <i class=" fa fa-ban fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_banned_tenant>0){
                                                                echo $total_banned_tenant;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>                                                         
                                                        </strong> 
                                                        <small>Banned Tenants</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>						
						
						<li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_sale_ads_query     = "SELECT * FROM tbl_flat_sell_ads";
                                                        $total_sale_ads_query_result = mysqli_query($con, $total_sale_ads_query);
                                                        if($total_sale_ads_query_result){
                                                            $total_sale_ads = mysqli_num_rows($total_sale_ads_query_result);
                                                        ?>
                                                        <i class=" fa fa-columns fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_sale_ads>0){
                                                                echo $total_sale_ads;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>Total Sale Ads</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                 <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_sale_ads_disapproved_query     = "SELECT * FROM tbl_flat_sell_ads WHERE approved='N'";
                                                        $total_sale_ads_disapproved_query_result = mysqli_query($con, $total_sale_ads_disapproved_query);
                                                        if($total_sale_ads_disapproved_query_result){
                                                            $total_sale_ads_disapproved = mysqli_num_rows($total_sale_ads_disapproved_query_result);
                                                        ?>
                                                        <i class=" fa fa-columns fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_sale_ads_disapproved>0){
                                                                echo $total_sale_ads_disapproved;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>New Sale Ads </small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_sale_ads_approved_query     = "SELECT * FROM tbl_flat_sell_ads WHERE approved='Y'";
                                                        $total_sale_ads_approved_query_result = mysqli_query($con, $total_sale_ads_approved_query);
                                                        if($total_sale_ads_approved_query_result){
                                                            $total_sale_ads_approved = mysqli_num_rows($total_sale_ads_approved_query_result);
                                                        ?>
                                                        <i class=" fa fa-check-circle fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_sale_ads_approved>0){
                                                                echo $total_sale_ads_approved;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>Approved Sale Ads</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_sale_ads_ban_query     = "SELECT * FROM tbl_flat_sell_ads WHERE ban='Y'";
                                                        $total_sale_ads_ban_query_result = mysqli_query($con, $total_sale_ads_ban_query);
                                                        if($total_sale_ads_ban_query_result){
                                                            $total_sale_ads_ban = mysqli_num_rows($total_sale_ads_ban_query_result);
                                                        ?>
                                                        <i class=" fa fa-ban fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_sale_ads_ban>0){
                                                                echo $total_sale_ads_ban;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>Ban Sale Ads </small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_rent_ads_query     = "SELECT * FROM tbl_flat_rent_ads";
                                                        $total_rent_ads_query_result = mysqli_query($con, $total_rent_ads_query);
                                                        if($total_rent_ads_query_result){
                                                            $total_rent_ads = mysqli_num_rows($total_rent_ads_query_result);
                                                        ?>
                                                        <i class=" fa fa-columns fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_rent_ads>0){
                                                                echo $total_rent_ads;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>Total Rent Ads</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                        <?php
                                                        $total_rent_ads_disapproved_query     = "SELECT * FROM tbl_flat_rent_ads WHERE approved='N'";
                                                        $total_rent_ads_disapproved_query_result = mysqli_query($con, $total_rent_ads_disapproved_query);
                                                        if($total_rent_ads_disapproved_query_result){
                                                            $total_rent_ads_disapproved = mysqli_num_rows($total_rent_ads_disapproved_query_result);
                                                        ?>
                                                        <i class=" fa fa-columns fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_rent_ads_disapproved>0){
                                                                echo $total_rent_ads_disapproved;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?> 
                                                        </strong> 
                                                        <small>New Rent Ads </small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                <li>
                                                    <div class="stat_text">
                                                         <?php
                                                        $total_rent_ads_approved_query     = "SELECT * FROM tbl_flat_rent_ads WHERE approved='Y'";
                                                        $total_rent_ads_approved_query_result = mysqli_query($con, $total_rent_ads_approved_query);
                                                        if($total_rent_ads_approved_query_result){
                                                            $total_rent_ads_approved = mysqli_num_rows($total_rent_ads_approved_query_result);
                                                        ?>
                                                        <i class=" fa fa-check-circle fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_rent_ads_approved>0){
                                                                echo $total_rent_ads_approved;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>
                                                        </strong> 
                                                        <small>Approved Rent Ads</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>
                                                
                                                <li>
                                                    <div class="stat_text">
                                                         <?php
                                                        $total_rent_ads_ban_query     = "SELECT * FROM tbl_flat_rent_ads WHERE ban='Y'";
                                                        $total_rent_ads_ban_query_result = mysqli_query($con, $total_rent_ads_ban_query);
                                                        if($total_rent_ads_ban_query_result){
                                                            $total_rent_ads_ban = mysqli_num_rows($total_rent_ads_ban_query_result);
                                                        ?>
                                                        <i class=" fa fa-ban fa-2x"></i> 	 
                                                        <strong>
                                                            <?php 
                                                            if($total_rent_ads_ban>0){
                                                                echo $total_rent_ads_ban;
                                                            }else{
                                                                echo '0';
                                                            }
                                                            ?>
                                                        </strong> 
                                                        <small>Ban Rent Ads</small>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
						</li>

					</ul>
				</div>
				<hr>

				
			</div>
			<!-- /.inner -->
		</div>
		<!-- /.outer -->
	</div>
	<!--Main Body Content Section End-->
            
            
<?php include 'inc/footer.php';?>        