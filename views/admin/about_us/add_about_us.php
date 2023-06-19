<div id="page-wrapper">
	<div class="header"> 
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Add About Us</li>
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
                            <div class="title">Add About Us Content</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/About_us/insert_about_us');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                	<textarea required="" class="form-control" rows="10" name="content"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update_profile" class="btn btn-primary">Add</button>
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