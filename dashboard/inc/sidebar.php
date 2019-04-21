	</header>
	<!-- /HEADER -->
    </div>
    <!-- /#top -->

    <div id="left">
	<!--ADMIN IMAGE AND NAME-->
	<div class="media user-media bg-dark dker">
		<div class="user-media-toggleHover">
                    <span class="fa fa-user"></span>
		</div>
		<div class="user-wrapper bg-dark">
                    <?php
                    global $con;
                    $admin_id = $_SESSION['id'];
                    $admin_email = $_SESSION['email'];
                    $query = "SELECT * FROM tbl_admin WHERE id='$admin_id' AND email='$admin_email'";
                    $result = mysqli_query($con, $query);
                    if($result){
                        $row = mysqli_fetch_array($result);
                    }
                    ?>
                    <a class="user-link" href="my-profile.php">
                        <?php 
                        if($row['profile_image'] == true){
                        ?>
                        <img class="media-object user-img" alt="User Picture" src="<?php echo $row['profile_image'];?>" style="border: 2px solid #333;">
                        
                        <?php
                        }else{
                        ?>
                        <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.png">
                        <?php
                        }
                        ?>
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading"><?php echo $row['username'];?></h5>
                        <ul class="list-unstyled user-info">
                            <li><a href="my-profile.php" style="color: #74a62b;">Administrator</a></li>
                        </ul>
                    </div>
		</div>
	</div>
	<!--/ADMIN IMAGE AND NAME-->
	<!-- MENU START-->
	<ul id="menu" class="bg-blue dker">
            <li class="nav-header">Menu</li>
            <li class="nav-divider"></li>
            <li class="">
                <a href="index.php">
                    <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span class="link-title">Users</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="owner.php">Owner's</a>
                    </li>
                    <li>
                        <a href="banned-owner.php">Banned Owner's </a>
                    </li>	
                    <li>
                        <a href="tenants.php">Tenant's</a>
                    </li>
                    <li>
                        <a href="banned-tenant.php">Banned Tenant's </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="javascript:;">
                    <i class="fa fa-columns"></i>
                    <span class="link-title">Ads</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="approved-sale-ads.php">Approved Sale Ads List</a>
                    </li>
                    <li>
                        <a href="new-sale-ads.php">New Sale Ads List</a>
                    </li>
                    <li>
                        <a href="ban-sale-ads.php">Ban Sale Ads List</a>
                    </li>
                    <li>
                        <a href="approved-rent-ads.php">Approved Rent Ads List</a>
                    </li>
                    <li>
                        <a href="new-rent-ads.php">New Rent Ads List</a>
                    </li>
                    <li>
                        <a href="ban-rent-ads.php">Ban Rent Ads List</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="fa fa-usd"></i>
                    <span class="link-title">Monthly Rent Transaction</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="rent-received-by-owner.php">Rent Received By Owner</a>
                    </li>
                    <li>
                        <a href="rent-paid-by-tenant.php">Rent Paid By Tenant</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="fa fa-flag"></i>
                    <span class="link-title">Notice</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="owner-notice-to-tenant.php">Owner Notice TO Tenant</a>
                    </li>
                    <li>
                        <a href="tenant-notice-to-owner.php">Tenant Notice TO Owner</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="customer-message.php">
                    <i class="fa fa-envelope"></i><span class="link-title">&nbsp;Customer Message To Owner</span>
                </a>
            </li>
            <li class="">
                <a href="inbox.php">
                    <i class="fa fa-envelope"></i><span class="link-title">&nbsp;Inbox</span>
                </a>
            </li>
            
	</ul>
</div>
<!-- /MENU END -->