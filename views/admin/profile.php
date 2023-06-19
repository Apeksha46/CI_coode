<style type="text/css">
    .mapControls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchMapInput {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchMapInput:focus {
      border-color: #4d90fe;
    }
</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Profile</li>
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
                            <div class="title">Edit Profile</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/Dashboard/edit_profile');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="admin_id" value="<?php echo $data->admin_id; ?>">
                                    <input type="text" name="name" class="form-control" value="<?php echo $data->name; ?>" id="inputEmail3" placeholder="Name">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="file">
                                    <img id="preview" src="<?php if(!empty( $data->profile)){ echo base_url().'uploads/'.$data->profile; }else{  ?>http://placehold.it/100x100 <?php } ?>" alt="your image" width="150px" height="120px" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Change Password</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="<?php echo site_url('admin/Dashboard/change_password');?>" method="post" >
                            <?php if($this->session->flashdata('_success')){ ?>
                                <div class="alert alert-info alert-dismissible" id="hideDivId">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                                  <strong>Success!</strong> <?php echo $this->session->flashdata('_success');?>
                                </div>
                            <?php } if($this->session->flashdata('_error')){  ?>
                                 <div class="alert alert-danger alert-dismissible" id="hideDivId">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                                  <strong>Error!</strong> <?php echo $this->session->flashdata('_error');?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="admin_id" value="<?php echo $data->admin_id; ?>">
                                    <input type="password" class="form-control" name="old_password" value="<?php echo $data->pwd; ?>" id="inputEmail3" readonly placeholder="Old Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password" id="password1" placeholder="New Password">
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
                                    <button disabled="" id="change_password" type="submit" name="change_password" class="btn btn-primary">Change Password</button>
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
<!-- /. WRAPPER  -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#password2").keyup(validate);
        // function changeProfile() {
        //     $('#image').click();
        // }
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
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if ((charCode < 48 || charCode > 57))
            return false;

        return true;
    }
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
    function initMap() {
      var input = document.getElementById('searchMapInput');
    
      var autocomplete = new google.maps.places.Autocomplete(input);
     
      autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          // document.getElementById('location-snap').value = place.formatted_address;
          document.getElementById('lat-span').value = place.geometry.location.lat();
          document.getElementById('lon-span').value = place.geometry.location.lng();
      });
  }
</script>
