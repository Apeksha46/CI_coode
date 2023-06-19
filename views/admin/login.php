

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="675800969903-n6nas9luoj0vcclv2qgsbevbs3ovj8vr.apps.googleusercontent.com">
<!-- <link rel="shortcut icon" type="img/icon" href="http://18.191.152.224/bright_future/assets/img/favicon.png"/> -->

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
background-image: url(<?php echo base_url() ?>uploads/bg.jpg);
background-repeat: no-repeat;
background-size: cover;
background-position: top center;
background-repeat: no-repeat;
    background-size: cover;
    background-color: #00000061;
    background-blend-mode: overlay;
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

/* helpers/grid.css */

.grid {
  margin-left: auto;
  margin-right: auto;
  max-width: 450px;
  width: 100%;
  background: rgba(255,255,255,.65);
  padding: 15px 30px 30px;
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
  fill: #fff;
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
  background-color: #181818;
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
  background-color: #2c2c2c;
}

.login input[type='submit'] {
  background-color: #181818;
  color: #eee;
  font-weight: 700;
  text-transform: uppercase;
}

.login input[type='submit']:focus,
.login input[type='submit']:hover {
  background-color: #f09e68;
}
.login input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #fafafa !important;

}
.login input::-moz-placeholder { /* Firefox 19+ */
  color: #fafafa !important;

}
.login input:-ms-input-placeholder { /* IE 10+ */
   color: #fafafa !important;

}
.login input:-moz-placeholder { /* Firefox 18- */
  color: #fafafa !important;

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
.img-brand{
  max-width: 100%;
  display: block;
  text-align: center;
  margin: auto;
}
.img-brand img{
  max-width: 100%;
  margin: 15px auto;
}
@media screen and (max-width: 735px) {
 .grid{
  width: 90%
 }
}

@media (min-width:736px) and (max-width: 1250px) {
}
</style>

<body class="align">

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
    <form action="<?php echo site_url('index.php/admin/Auth/login');?>" method="POST" class="form login">

      <a class="img-brand" href="<?php echo site_url('admin/Auth/'); ?>"><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="img-responsive" width="200;"></a>


      <div class="form__field">
        <label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Email</span></label>
        <input id="login__username" type="text" autocomplete="off" name="email" class="form__input" placeholder="Email" required>
      </div>

      <div class="form__field">
        <label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
        <input id="login__password" autocomplete="off" type="password" name="password" class="form__input" placeholder="Password" required>
      </div>

      <div class="form__field">
        <input type="submit" value="Sign In">
      </div>
      

     <!--  <div class="form__field" >
        <a style="margin-left: 0%;" href="<?php echo site_url('admin/Auth/sign_up'); ?>">Sign Up</a>&nbsp;&nbsp;&nbsp;
        <a style="margin-left: 42%;" href="<?php echo site_url('admin/Auth/forget_password'); ?>">Forgot Password</a>
      </div> -->

    </form>

  </div>

  <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

//LOGIN 

function facebook_signup(oauth_id, name, email, gender, birthday, image_url, token,first_name, last_name)
{
  var dataString = 'oauth_id='+oauth_id+'&name='+name+'&email='+email+'&gender='+gender+'&birthday='+birthday+'&image_url='+image_url+'&token='+token+'&first_name='+first_name+'&last_name='+last_name;

  var base_url = '<?php echo base_url();?>';
  var url = base_url+'account/facebook_login';

  $.ajax({

    type:"POST",
    data:dataString,
    url:url,
    dataType:"json",
    success:function(response)
    { 
        if(response == 1)
        {

        window.location='home.php';
        }
        else
        {
        alert("server error");
        }
    }

  });
}
   
window.fbAsyncInit = function() 
{
  FB.init({
     appId:'1167392710111143', cookie:true,
     status:true, xfbml:true,oauth : true
   });
};
(function(d)
{
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
}(document));
   
$(document).ready(function()
{
  $('.btn-fblogin').click(function(e)
  {
    FB.login(function(response) 
    {
      if(response.authResponse) 
      {
        FB.api('/me?fields=id,name,birthday,first_name,last_name,email,gender,locale,picture', function(response) 
        {
          var token = FB.getAccessToken();
          if(typeof response.id == 'string')
          {
              var oauth_id = response.id;
          }
          else
          {
              var oauth_id = '';
          }

          if(typeof response.name == 'string')
          {
              var name = response.name;
          }
          else
          {
              var name = '';
          }

          if(typeof response.first_name == 'string')
          {
              var first_name = response.first_name;
          }
          else
          {
              var first_name = '';
          }

          if(typeof response.last_name == 'string')
          {
              var last_name = response.last_name;
          }
          else
          {
              var last_name = '';
          }

          if(typeof response.email == 'string')
          {
              var email = response.email;
          }
          else
          {
              var email = '';
          }

          if(typeof response.gender == 'string')
          {
              var gender = response.gender;
          }
          else
          {
              var gender = '';
          }

          if(typeof response.birthday == 'string')
          {
              var birthday = response.birthday;
          }
          else
          {
              var birthday = '';
          }

          if(typeof response.picture.data.url == 'string')
          {
              var image_url = response.picture.data.url;
          }
          else
          {
              var image_url = '';
          }


          facebook_signup(oauth_id, name, email, gender, birthday, image_url, token, first_name, last_name);

        });
      }
      else
      {
          alert('There is an error occured. Please try again.');
      }
    });
  });
});

// END LOGIN

//START GOOGLE LOGIN
  
function onSignIn(googleUser) {
  // Useful data for your client-side scripts:
  var profile = googleUser.getBasicProfile();
  console.log("ID: " + profile.getId()); // Don't send this directly to your server!
  console.log('Full Name: ' + profile.getName());
  console.log('Given Name: ' + profile.getGivenName());
  console.log('Family Name: ' + profile.getFamilyName());
  console.log("Image URL: " + profile.getImageUrl());
  console.log("Email: " + profile.getEmail());

  // The ID token you need to pass to your backend:
  var id_token = googleUser.getAuthResponse().id_token;
  console.log("ID Token: " + id_token);
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
}
  
//END GOOGLE LOGIN

 </script>