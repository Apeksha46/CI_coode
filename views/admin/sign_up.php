<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" type="img/icon" href="http://18.191.152.224/bright_future/assets/img/favicon.png"/>

<style type="text/css">
  /* config.css */

/* helpers/align.css */

 .align a
  {
    color: #000;
    font-weight: bold;
  }
.align {
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-image: url(http://18.191.152.224/bright_future/uploads/shopping.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: top center;
}
.grid {
  margin-left: auto;
  margin-right: auto;
  max-width: 450px;
  width: 100%;
  background: rgba(255,255,255,.9);
  padding: 15px 30px;
}
@media only screen and (max-width: 400px) {
  .grid{
    max-width: 400px !important;
  }
}
@media only screen and (max-width: 767px) {
  .align{
    height: auto;
    padding: 15px;
  }
}

/* Change Autocomplete styles in Chrome*/
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
 
  -webkit-text-fill-color: #606468;
  -webkit-box-shadow: 0 0 0px 1000px #3b4148 inset;
  transition: background-color 5000s ease-in-out 0s;
}



/* helpers/hidden.css */

.hidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

/* helpers/icon.css */

.icons {
  display: none;
}

.icon {
  display: inline-block;
  fill: #606468;
  font-size: 16px;
  font-size: 1rem;
  height: 1em;
  vertical-align: middle;
  width: 1em;
}

/* layout/base.css */

* {
  -webkit-box-sizing: inherit;
          box-sizing: inherit;
}

html {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  font-size: 100%;
  height: 100%;
}

body {
  background-color: #2c3338;
  color: #606468;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  font-size: 0.875rem;
  font-weight: 400;
  height: 100%;
  line-height: 1.5;
  margin: 0;
  min-height: 100vh;
}

/* modules/anchor.css */

a {
  color: #eee;
  outline: 0;
  text-decoration: none;
}

a:focus,
a:hover {
  text-decoration: underline;
}

/* modules/form.css */

input {
  background-image: none;
  border: 0;
  color: inherit;
  font: inherit;
  margin: 0;
  outline: 0;
  padding: 0;
  -webkit-transition: background-color 0.3s;
  transition: background-color 0.3s;
}

input[type='submit'] {
  cursor: pointer;
}

.form {
  margin: -14px;
  margin: -0.875rem;
}

.form input[type='password'],
.form input[type='text'],
.form input[type='submit'] {
  width: 100%;
}

.form__field {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin: 14px;
  margin: 0.875rem;
}

.form__input {
  -webkit-box-flex: 1;
      -ms-flex: 1;
          flex: 1;
}

/* modules/login.css */

.login {
  color: #eee;
}

.login label,
.login input[type='text'],
.login input[type='password'],
.login input[type='submit'] {
  border-radius: 0.25rem;
  padding: 16px;
  padding: 1rem;
}

.login label {
  background-color: #1b2a47;
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  padding-left: 20px;
  padding-left: 1.25rem;
  padding-right: 20px;
  padding-right: 1.25rem;
}

.login input[type='password'],
.login input[type='text'] {
  background-color: #3b4148;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.login input[type='password']:focus,
.login input[type='password']:hover,
.login input[type='text']:focus,
.login input[type='text']:hover {
  background-color: #434a52;
}

.login input[type='submit'] {
  background-color: #1b2a47;
  color: #eee;
  font-weight: 700;
  text-transform: uppercase;
}

.login input[type='submit']:focus,
.login input[type='submit']:hover {
  background-color: #253557;
}

/* modules/text.css */

p {
  margin-bottom: 24px;
  margin-bottom: 1.5rem;
  margin-top: 24px;
  margin-top: 1.5rem;
}

.text--center {
  text-align: center;
}
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

#seller_email {
    background: #3b4148 !important; height: 48px;
    padding-left: 15px;    border-radius: 0 5px 5px 0px;
}

.mapControls {
    height: 48px !important;
    background: #3b4148 !important;
    margin-left: 0px !important;
    margin-top: 0px !important;
}
.img-brand{
  max-width: 100px;
  display: block;
  text-align: center;
  margin: auto;
}
.img-brand img{
  width: 100%;
  margin: 15px auto;
}

</style>

<body >
  <div class="align">
    <div class="grid">
    <!-- <?php 
    // echo validation_errors(); 
    ?> -->
    <?php if(validation_errors()){ ?>
    <div class="alert alert-danger alert-dismissible" id="hideDivId">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error!</strong> <?php echo validation_errors();?>
    </div>
    <?php } if($this->session->flashdata('success')){ ?>
        <div class="alert alert-danger alert-dismissible" id="hideDivId">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
        </div>
    <?php } if($this->session->flashdata('error_login')){  ?>
         <div class="alert alert-danger alert-dismissible" id="hideDivId">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> <?php echo $this->session->flashdata('error_login');?>
        </div>
    <?php } ?>
    <form action="<?php echo site_url('seller/Auth/register');?>" method="POST" class="form login">

      <a class="img-brand" href="<?php echo site_url('admin/Auth/Dashboard'); ?>"><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="img-responsive"></a>

      <?php if($this->session->flashdata('error_login')){  ?>
         <div class="alert alert-danger alert-dismissible" id="hideDivId">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> <?php echo $this->session->flashdata('error_login');?>
        </div>
    <?php } ?>
    
      <div class="form__field">
        <label for="first_name"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">First Name</span></label>
        <input style="color:#fff;" type="text" name="seller_first_name" class="form__input" placeholder="First Name" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="last_name"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Last Name</span></label>
        <input style="color:#fff;" type="text" name="seller_last_name" class="form__input" placeholder="Last name" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="business_name">
         
        <img class="icon" src="<?php echo base_url()?>assets/img/briefcase.svg">

          <span class="hidden">Business Name</span></label>
        <input style="color:#fff;" type="text" name="seller_business_name" class="form__input" placeholder="Business Name" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="business_address">
        <img class="icon" src="<?php echo base_url()?>assets/img/maps-and-flags.svg">
        <span class="hidden">Business Address</span></label>

        <input style="color:#fff;" type="text" name="seller_business_address" class="mapControls form__input" placeholder="Business Address" id="searchMapInput" required autocomplete = "off">
        <input type="hidden" name="seller_latitude" id="lat-span">
        <input type="hidden" name="seller_longitude" id="lon-span">
      </div>
      <div class="form__field">
        <label for="city">
        <img class="icon" src="<?php echo base_url()?>assets/img/maps-and-flags.svg">
        <span class="hidden">City</span></label>

        <input style="color:#fff;" type="text" name="city" class="form__input" placeholder="Enter City" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="mobile">       
         <img class="icon" src="<?php echo base_url()?>assets/img/mobile.svg">
          <span class="hidden">Mobile</span></label>
        <input style="color:#fff;" type="text" name="seller_mobile" onkeypress="return isNumberKey(event)" maxlength="10"  minlength="10" class="form__input" placeholder="Mobile" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="email">
                   <img class="icon" src="<?php echo base_url()?>assets/img/mail-black-envelope-symbol.svg">

          <span class="hidden">Email</span></label>
        <input style="color:#fff;" type="email" onblur="checkEmail();" id="seller_email" name="seller_email" class="form__input" placeholder="Email" required autocomplete = "off">
      </div>
      <div id="msg" ></div>
      <div class="form__field">
        <label for="password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
        <input style="color:#fff;" id="password1" type="password" name="seller_password" class="form__input" placeholder="Password" required autocomplete = "off">
      </div>
      <div class="form__field">
        <label for="confirm_password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Confirm Password</span></label>
        <input style="color:#fff;" type="password" name="confirm_password" id="password2" class="form__input" placeholder="Confirm Password" required autocomplete = "off">
        <br/><p id="validate-status"></p>
      </div>
      <div class="form__field">
        <input type="submit" value="Sign Up" onclick="return checkEmail(); ">
      </div>

      <div class="form__field">
        <a style="margin-left: 0%;" href="<?php echo site_url('seller/Auth/login'); ?>">Login</a>&nbsp;&nbsp;&nbsp;
        <a style="margin-left: 45%;" href="<?php echo site_url('seller/Auth/forget_password'); ?>">Forget Password</a>
      </div>

    </form>

  </div>
  </div>

  

  <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
  $( document ).ready(function() {
    $("#password2").keyup(validate);
  });
  function checkEmail()
  {
    var seller_email = $("#seller_email").val();
    $.ajax({
      url: '<?php echo site_url('seller/Auth/checkEmail'); ?>',
      type: "POST",
      data: {
          "seller_email" : seller_email
      },
      success: function (response) {
        if (response == '1') {
            setTimeout(function(){ 
                $('#msg').html('<div class="alert alert-success" style = "color : red"><strong>Category!</strong> Email already exists.</div>');
            }, 3000);
            return false;
        } else{
          return true;
        }
        // location.reload();
      }
    });
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
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
      return false;
    return true;
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