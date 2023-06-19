<link rel="stylesheet" href="<?php echo base_url();?>ckeditor/samples/sample.css">
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Account Detail</li>
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
                            <div class="title">Account Detail</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php } if($this->session->flashdata('error')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                            </div>
                        <?php } ?>
                        <form class="form-horizontal" action="<?php echo site_url('seller/Account/update_account');?>" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Merchant Id</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="merchant_id" value="<?php if (!empty($tableData->merchant_id)) { echo $tableData->merchant_id; } ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Working Key</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="workingKey" value="<?php if (!empty($tableData->workingKey)) { echo $tableData->workingKey; } ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Access Code</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="access_code" value="<?php if (!empty($tableData->access_code)) { echo $tableData->access_code; } ?>" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    <a target="_blank" href="https://www.ccavenue.com/" class="btn btn-warning">Create Account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>