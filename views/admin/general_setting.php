<link rel="stylesheet" href="<?php echo base_url();?>ckeditor/samples/sample.css">
<div id="page-wrapper">
	<div class="header"> 
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">General Setting</li>
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
                            <div class="title">Edit General Setting</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success_setting')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success_setting');?>
                            </div>
                        <?php } if($this->session->flashdata('error_setting')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error_setting');?>
                            </div>
                        <?php } ?>
                        <form class="form-horizontal" action="<?php echo site_url('admin/General_Setting/update_general_setting');?>" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="hidden" required="" class="form-control" name="general_setting_id" value="<?php if (!empty($tableData[0]['general_setting_id'])) { echo $tableData[0]['general_setting_id']; } ?>" >
                                    <input type="text" required="" class="form-control" name="address" value="<?php if (!empty($tableData[0]['address'])) { echo $tableData[0]['address']; } ?>" Placeholder="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Postal Code</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="postal_code" value="<?php if (!empty($tableData[0]['postal_code'])) { echo $tableData[0]['postal_code']; } ?>" onkeypress="return isNumberKey(event)" Placeholder="Postal Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Mobile No.</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="mobile" value="<?php if (!empty($tableData[0]['mobile'])) { echo $tableData[0]['mobile']; } ?>" onkeypress="return isNumberKey(event)" Placeholder="Mobile No.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Alternate Mobile No.</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alt_mobile" value="<?php if (!empty($tableData[0]['alt_mobile'])) { echo $tableData[0]['alt_mobile']; } ?>" onkeypress="return isNumberKey(event)" Placeholder="Alternate Mobile No.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email 1</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="email_1" value="<?php if (!empty($tableData[0]['email_1'])) { echo $tableData[0]['email_1']; } ?>"  Placeholder="Email 1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Website 1</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="email_2" value="<?php if (!empty($tableData[0]['email_2'])) { echo $tableData[0]['email_2']; } ?>" Placeholder="Website 1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Website 2</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="email_3" value="<?php if (!empty($tableData[0]['email_3'])) { echo $tableData[0]['email_3']; } ?>" Placeholder="Website 3">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Facebook Link </label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="facebook" value="<?php if (!empty($tableData[0]['facebook'])) { echo $tableData[0]['facebook']; } ?>" Placeholder="Facebook Link">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Twitter Link</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="twittter" value="<?php if (!empty($tableData[0]['twittter'])) { echo $tableData[0]['twittter']; } ?>" Placeholder="Twitter Link">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Instagram Link</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="instagram" value="<?php if (!empty($tableData[0]['instagram'])) { echo $tableData[0]['instagram']; } ?>" Placeholder="Instagram Link">
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
<script src="<?php echo base_url() ;?>ckeditor/ckeditor.js">  </script>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1', {
        fullPage: true,
        allowedContent: true,
        extraPlugins: 'wysiwygarea'
    });
</script>