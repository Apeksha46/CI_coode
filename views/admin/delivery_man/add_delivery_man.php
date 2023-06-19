<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Delivery Man <small>Xiri</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Delivery_man');?>">Delivery Man</a></li>/
			<li class="active">Add Delivery Man</li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Add Delivery Man Content</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/Delivery_man/insert_delivery_man');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                	<input type="text" name="delivery_man_first_name" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="delivery_man_last_name" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-10">
                                    <input type="text" name="delivery_man_contact" class="form-control" required="" minlength="10" maxlength="10" id="inputEmail3" placeholder="Delivery Man Contact" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="delivery_man_address" class="form-control" required="" id="inputEmail3" placeholder="Delivery Man Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Vehicle Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="driver_vehicle_number" class="form-control" required="" id="inputEmail3" placeholder="Vehicle Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="delivery_man_email" class="form-control" required="" id="inputEmail3" placeholder="DeliveryMan@gmail.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="delivery_man_pwd" class="form-control" required="" id="inputEmail3" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control mb15" id="image" name="image" placeholder="file">
                                    <img id="preview" src="http://placehold.it/100x100" alt="your image" width="150px" height="120px" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="add_Delivery Man" class="btn btn-primary">Add</button>
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