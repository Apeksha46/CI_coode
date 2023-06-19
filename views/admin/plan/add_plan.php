<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Plan');?>">Plan</a></li>
			<li class="active">Add Plan</li>
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
                            <div class="title">Add Plan</div>
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
                        <form class="" action="<?php echo site_url('admin/Plan/insert_plan');?>" enctype="multipart/form-data" method="post">


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Plan</label>
                                    <input type="text" name="plan_name" class="form-control" id="inputEmail3" required="" placeholder="Plan Name">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">No.of Day's</label>
                                    <input type="text" name="days" class="form-control" id="inputEmail3" required="" onkeypress="return isNumberKey(event)" placeholder="No.of Day's">
                            </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Price</label>
                                    <input type="text" name="price" class="form-control" id="inputEmail3" onkeypress="return isNumberKey(event)" required="" placeholder="Price">
                            </div>
                                </div>
                                <div class="col-sm-6"></div>
                            </div>

                            
                            <button type="submit" name="add_plan" class="btn btn-primary">Add</button>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>