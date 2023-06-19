<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/SubCategory');?>">Sub Category</a></li>
			<li class="active">Edit Sub Category</li>
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
                            <div class="title">Edit Sub Category</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/SubCategory/update_sub_category');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id">
                                        <?php
                                            foreach ($cat as $key) { ?>
                                                <option <?php if($key['category_id']==$tableData->category_id){ echo 'selected'; } ?> value="<?php echo $key['category_id']; ?>" ><?php echo $key['category_name']; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Sub-Category Name</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="sub_category_id" value="<?php echo $tableData->sub_category_id; ?>">
                                    <input type="text" name="sub_category_name" class="form-control" required="" id="inputEmail3" placeholder="Sub Category Name" value="<?php echo $tableData->sub_category_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="file">
                                    <img id="preview" src="<?php if(!empty( $tableData->sub_category_image)){ echo base_url().'sub_category/'.$tableData->sub_category_image; }else{  ?>http://placehold.it/100x100 <?php } ?>" alt="your image" width="150px" height="120px" />
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
        $('#image').change(function () {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
            //$("#remove").val(0);
                };
            }
        }
        function removeImage() {
            $('#preview').attr('src', 'noimage.jpg');
            //$("#remove").val(1);
        }
    });
</script>