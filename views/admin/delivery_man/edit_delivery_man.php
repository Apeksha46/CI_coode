<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Delivery_man');?>">Delivery Man</a></li>
			<li class="active">Edit Delivery Man</li>
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
                            <div class="title">Edit Delivery Man</div>
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
                        <form class="" action="<?php echo site_url('admin/Delivery_man/update_delivery_man');?>" enctype="multipart/form-data" method="post">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="inputEmail3" class="control-label">First Name</label>
                                        <input type="hidden" name="delivery_man_id" value="<?php echo $tableData->delivery_man_id; ?>">
                                        <input type="text" name="delivery_man_first_name" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man First Name" value="<?php echo $tableData->delivery_man_first_name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Last Name</label>
                                    <input type="text" name="delivery_man_last_name" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man Last Name" value="<?php echo $tableData->delivery_man_last_name; ?>">
                            </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Contact</label>
                                    <input type="text" name="delivery_man_contact" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man Contact" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" value="<?php echo $tableData->delivery_man_contact; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Address</label>
                                    <input type="text" name="delivery_man_address" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man Address" value="<?php echo $tableData->delivery_man_address; ?>">
                            </div>
                                </div>
                            </div>

                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Vehicle Number</label>
                                    <input type="text" name="driver_vehicle_number" class="form-control" required="" id="inputEmail3" placeholder="Vehicle Number" value="<?php echo $tableData->driver_vehicle_number; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Email</label>
                                    <input type="email" name="delivery_man_email" class="form-control" required="" id="inputEmail3" placeholder="DeliveryMan@gmail.com" value="<?php echo $tableData->delivery_man_email; ?>">
                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Password</label>
                                    <input type="password" name="delivery_man_pwd" class="form-control" required="" id="inputEmail3" value="<?php echo $tableData->delivery_man_pwd; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputPassword3" class="control-label">Profile Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="file">
                                    <img id="preview" src="<?php if(!empty( $tableData->delivery_man_profile)){ echo base_url().'delivery_man/'.$tableData->delivery_man_profile; }else{  ?>http://placehold.it/100x100 <?php } ?>" alt="your image" width="150px" height="120px" />
                            </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
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