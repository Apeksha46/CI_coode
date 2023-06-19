<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Aananddisha</title>
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- owl carousel CSS -->
      <!-- ----- -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
      <!-- web font CSS -->
      <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
      <!-- style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
      <style type="text/css">
        .form-ui .form-control{
          color: black !important ;
        }
      </style>
   </head>

   <body>

        <section class="top-selling-product-detail pt-5">
         <div class="container-fluid">
            <div class="send-money-page">
               <div class="container">
                  <?php if($this->session->flashdata('success_')){ ?>
                        <div class="alert alert-info alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success!</strong> <?php echo $this->session->flashdata('success_');?>
                        </div>
                    <?php } if($this->session->flashdata('error_')){  ?>
                         <div class="alert alert-danger alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> <?php echo $this->session->flashdata('error_');?>
                        </div>
                    <?php } ?>
                    
                    <?php 
                      $session_value = $this->session->userdata('web_logged_in');
                      $user = $this->CommonModel->selectRowDataByCondition(array('user_id' => $session_value['id']),'user');
                      // print_r($user->first_name);
                     ?>
                  <div class="row">
                    <?php if(!empty( $user->profile)){ ?>
                      <div class="col-md-9"> 
                        <div class="recent-activity form-ui">
                          <img id="preview" src="<?php echo base_url().'uploads/'.$user->profile; ?>" alt="your image" width="150px" height="120px" />
                        </div>
                      </div>
                    <?php } ?>
                    <div class="col-md-9">
                        <div class="recent-activity form-ui">
                           <p> <i class="ti-user"></i>&nbsp; Personal Details</p>
                            <form action="<?php echo base_url('website1/Auth/update_profile'); ?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">First Name</label>
                                       <input name="first_name" type="text" value="<?php if(!empty($user)){ echo $user->first_name; }  ?>" placeholder="First Name" class="form-control" >
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">Last Name</label>
                                       <input name="last_name" value="<?php if(!empty($user)){ echo $user->last_name; }  ?>" type="text" placeholder="Last Name" class="form-control" >
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">Mobile No.</label>
                                       <input name="mobile" value="<?php if(!empty($user)){ echo $user->mobile; }  ?>" type="text" placeholder="+91" class="form-control" >
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">Upload image</label>
                                       <div class="custom-file"> 
                                          <input type="file" class="custom-file-input" id="image"  name="file">
                                          <label class="custom-file-label" for="customFile"><i class="ti-cloud-down">  </i> Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <button type="submit" class=" btn "> Save Changes</button>
                                 </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('_success')){ ?>
                        <div class="alert alert-info alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success!</strong> <?php echo $this->session->flashdata('_success');?>
                        </div>
                    <?php } if($this->session->flashdata('_error')){  ?>
                         <div class="alert alert-danger alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> <?php echo $this->session->flashdata('_error');?>
                        </div>
                    <?php } ?>
                    <div class="col-md-9">
                        <div class="recent-activity form-ui">
                           <p> <i class="ti-user"></i>&nbsp; Password Change</p>
                           <form action="<?php echo base_url('website1/Auth/reset_password'); ?>" method="post">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">New Password</label>
                                       <input name="new_password" type="password" placeholder="*******" id="password1" class="form-control" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="name">Confirm Password
                                       </label>
                                       <input name="confirm_password" type="password" placeholder="*******" id="password2" class="form-control" required>
                                       <span id="validate-status"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <button type="submit" class=" btn " id="change_password" disabled=""> Save Changes</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                    </div>
               </div>
            </div>
         </div>
      </section>
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
   </body>
</html>