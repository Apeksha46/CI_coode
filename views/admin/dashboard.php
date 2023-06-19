<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="#">Home</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <a href="<?php echo site_url('admin/User/total_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $user; ?></h3>
                                    <small>Total User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/User/direct_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $direct_user; ?></h3>
                                    <small>Direct User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/User'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $without_user; ?></h3>
                                    <small>Normal User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Package/bronze_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $bronze_user; ?></h3>
                                    <small>Bronze User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Package/silver_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $silver_user; ?></h3>
                                    <small>Silver User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Package/gold_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $gold_user; ?></h3>
                                    <small>Gold User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Package/platinum_user'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $platinum_user; ?></h3>
                                    <small>Platinum User</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Order/pending_order'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $pending; ?></h3>
                                    <small>Pending Order</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Order/dispatch_order'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $dispatch; ?></h3>
                                    <small>Dispatch Order</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Order/cancel_order'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $cancel; ?></h3>
                                    <small>Cancel Order</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Order/return_order'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $return; ?></h3>
                                    <small>Return Order</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo site_url('admin/Order/complete_order'); ?>">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3><?php echo $complete; ?></h3>
                                    <small>Complete<br/> Order</small>
                                </h3> 
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x RGB"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->

