<div id="page-wrapper">
	<div class="header"> 
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Delivery_Charges');?>">Delivery Charges</a></li>
			<li class="active">Edit Delivery Charges</li>
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
                            <div class="title">Edit Delivery Charges</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php } if($this->session->flashdata('error')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                            </div>
                        <?php } ?>
                        <form class="form-horizontal" action="<?php echo site_url('admin/Delivery_Charges/update_delivery_charges');?>" method="post">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="inputEmail3" class="control-label">Delivery Charges Per Km</label>
                                <div class="">
                                    <?php
                                        // print_r($tableData);
                                        if(!empty($tableData)){ 
                                            $data = $tableData[0]['delivery_charges_id']; 
                                            $amt  = $tableData[0]['delivery_charges_amount']; 
                                        }else{ 
                                            $data = ''; 
                                            $amt  = ''; 
                                        }
                                    ?>
                                    <input type="hidden" name="delivery_charges_id" value="<?php echo $data; ?>">
                                    <input type="text" name="delivery_charges_amount" class="form-control" onkeypress="return isNumberKey(event)" id="inputEmail3" required="" placeholder="Delivery Charges Per Km" value="<?php echo $amt; ?>">
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
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