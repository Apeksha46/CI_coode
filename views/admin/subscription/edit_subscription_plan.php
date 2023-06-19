<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Subscription_Plan');?>">Subscription Plan</a></li>
			<li class="active">Edit Subscription Plan</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Edit Subscription Plan</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php } if($this->session->flashdata('error_login')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error_login');?>
                            </div>
                        <?php } ?>
                        <form class="" action="<?php echo site_url('admin/Subscription_Plan/update_subscription_plan');?>" enctype="multipart/form-data" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Subscription Plan</label>
                                    <input type="hidden" name="subscription_plan_id" value="<?php echo $tableData->subscription_plan_id; ?>">
                                    <input type="text" name="plan_name" class="form-control" id="inputEmail3" required="" placeholder="Subscription Plan Name" value="<?php echo $tableData->subscription_plan_name; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">No.of Day's</label>
                                    <input type="text" name="days" class="form-control" id="inputEmail3" required="" value="<?php echo $tableData->days; ?>" onkeypress="return isNumberKey(event)" placeholder="No.of Day's">
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Price</label>
                                    <input type="text" name="price" class="form-control" id="inputEmail3" value="<?php echo $tableData->price; ?>" onkeypress="return isNumberKey(event)" required="" placeholder="Price">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Gst Tax</label>
                                    <input type="text" name="gstTax" class="form-control" id="inputEmail3" value="<?php echo $tableData->gstTax; ?>" onkeypress="return isNumberKey(event)" required="" placeholder="Gst Tax">
                            </div>
                                </div>
                            </div>

                            <button type="submit" name="update" class="btn btn-primary">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>