<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Privacy Policy</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Privacy Policy
                    </div>
                    <div id="msg"></div>
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
                    <div class="panel-body">
                		<form class="form-horizontal" action="<?php echo site_url('admin/Privacy_Policy/update_policy'); ?>" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" class="form-control" name="title" value="<?php if (!empty($tableData[0]['title'])) { echo $tableData[0]['title']; } ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="termCondition_id" value="<?php if (!empty($tableData[0]['termCondition_id'])) { echo $tableData[0]['termCondition_id']; } ?>">
                                    <textarea required="" id="editor1" class="ckeditor" name="content"><?php if (!empty($tableData[0]['content'])) { echo $tableData[0]['content']; } ?></textarea>
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
                <!--End Advanced Tables -->
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