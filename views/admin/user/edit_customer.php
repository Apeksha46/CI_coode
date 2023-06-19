<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Customer <small>Xiri</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/User/customer');?>">Customer</a></li>
			<li class="active">Edit Customer</li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Edit Customer</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/User/update_customer');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="customer_id" value="<?php echo $tableData->customer_id; ?>">
                                    <input type="text" name="customer_first_name" class="form-control" id="inputEmail3" placeholder="Customer First Name" value="<?php echo $tableData->customer_first_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="customer_last_name" class="form-control" id="inputEmail3" placeholder="Customer Last Name" value="<?php echo $tableData->customer_last_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-10">
                                    <input type="text" name="customer_mobile" class="form-control" id="inputEmail3" placeholder="Customer Contact" onkeypress="return isNumberKey(event)" value="<?php echo $tableData->customer_mobile; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="customer_email" class="form-control" id="inputEmail3" placeholder="Customer Email" value="<?php echo $tableData->customer_email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password" id="password1" placeholder="New Password" value="<?php echo $tableData->customer_password; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="confirm_password" id="password2" placeholder="Confirm Password">
                                    <p id="validate-status"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $("#password2").keyup(validate);
    });
    function validate() {
      var password1 = $("#password1").val();
      var password2 = $("#password2").val();

        if(password1 == password2) {
            $("#validate-status").css('color','green');
            $("#validate-status").text("valid");       
            $('#change_password').prop('disabled', false); 
        }
        else {
            $('#change_password').prop('disabled', true); 
            $("#validate-status").css('color','red');
            $("#validate-status").text("invalid");  
        }
        
    }
</script>