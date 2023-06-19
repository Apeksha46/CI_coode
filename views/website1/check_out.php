<style type="text/css">
	.form-ui .form-control {
		color: black;
	}
</style>
<section class="find-normal-section  m-5">
    <div class="container-fluid">
        <div class="checkout-area ">
            <form method="Post" action="<?php echo site_url('website1/CheckOut/proceed');?>" id="demo-form" data-parsley-validate="">
                <div class="row  shadow pt-4">
                    <div class="col-lg-6 col-md-6">
                       <div class="checkbox-form">
                          <h3>Billing Details</h3>
                            <!-- <input type="hidden" name="product_id" class="form-control" value="<?php echo $product->product_id; ?>" id="product_id"> -->
                            <!-- <input type="hidden" name="product_price" class="form-control" value="<?php echo $product->price; ?>"> -->
                          <div class="row  theme-form form-ui">
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">First Name <span class="required">*</span></label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required="">
                                    
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Last Name <span class="required">*</span></label>
                                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required="">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Email Address <span class="required">*</span></label>
                                   <input type="email" name="email" data-parsley-trigger="change" required="" class="form-control" id="email" placeholder="Email" required="">
                                   <input type="hidden" name="user_id" id="user_id">
                                   <span id="err_email" style="color: red;"></span>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Phone  <span class="required">*</span></label>
                                   <input type="text" name="phone" onkeypress="return isNumberKey(event)" class="form-control" id="phone" placeholder="Phone" required="">
                                </div>
                             </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label class="label-dark">Address <span class="required">*</span></label>
                                  <input type="text" name="address" class="form-control" id="address" placeholder="Address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10" required="">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Country <span class="required">*</span></label>
                                   

                                    <select required="" class="form-control" name="country" onchange="getState(101);">
                                           
                                                <option value="101" >
                                                    India 
                                                </option>
                                           
                                    </select>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">State</label>

                                   <select required="" class="form-control" id="state" name="state_id" onchange="getCity(this.value);">
                                    </select>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">City <span class="required">*</span></label>
                                    <select class="form-control" id="city" name="city_id">
                                   </select>
                                </div>
                             </div>
                             
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Postcode / Zip <span class="required">*</span></label>
                                   <!-- onkeyup="checkPostalCode(this.value);" -->
                                   <input type="text" name="postcode"  class="form-control" id="postcode" placeholder="Postcode / Zip" required="" onkeypress="return isNumberKey(event)">
                                   <div id="err_pin"></div>
                                </div>
                             </div>
                            <!--  <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label-dark">Refferal Code(optional) <span class="required"></span></label>
                                   <input type="text" name="refer_card" class="form-control" id="refer_card" placeholder="Referal Code" >
                                </div>
                             </div> -->
                          </div>
                       </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                       <div class="your-order">
                          <h3>Product Detail</h3>
                          <form class="form-ui form-group">
                             <div class="products">
                                <?php
                                  // print_r($cart);
                                  $total = 0;
                                  foreach ($cart as $key => $value) {
                                    $total = (int)$total + (int)$value['price'];
                                ?>
                                <div class="row">
                                  <div class="col-md-6">
                                      <div class="item">
                                        <span><?php echo $value['product_name']; ?></span>*
                                        <span><?php echo $value['quantity']; ?></span>
                                        <input type="hidden" name="quantity" value="<?php echo $value['quantity']; ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="item float-right">
                                      <span><?php echo $value['price']; ?></span>
                                    </div>
                                  </div>
                                </div>
                                
                                <?php } ?>
                                <div class="row float-right mb-3 mt-3" id="total">
                                  <div id="col-md-12" style="float: right;">
                                    <strong id="strongg">Total : <?php echo $total; ?></strong>
                                    <input type="hidden" name="total_amount" id="total_amount1" value="<?php echo $total; ?>">
                                    <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total; ?>">
                                  </div>
                                </div>
                                
                             <h5 class="d-inline-block">If you ready for payment, So click on proceed button</h5>
                             <div>
                               <input type="checkbox" name="term" id="chkterms" value="1"><a href="<?php echo site_url();?>website1/Auth/term_and_condition"> I accept term & Condition </a> 
                               <br/>
                               <?php
                                $sesData = $this->session->userdata('web_logged_in');
                               // print_r();exit;
                                if (isset($sesData['id'])) { ?>
                                    <input type="checkbox" name="wallet" value="1"> Use wallet or not
                                    <div class="form-group ">
                                      <button type="submit" onclick="return termCheck();" class="btn  btn-block" id="proceed">Proceed</button>
                                   </div>
                                <?php }else{ ?>
			                            <div class="form-group ">
			                                <a class="btn  btn-block" class="nav-link" href="<?php echo base_url(); ?>website1/Auth/login" >Proceed</a>
			                            </div>
                                <?php }
                               ?>
                             </div>
                          </form>
                       </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
	function termCheck()
	{
		if ($('#chkterms').is(':checked')) {
            return true;
        }
        else {
            alert('please check terms & conditions');
            return false;
        }
	}
</script>



<?php 
if(isset($_POST["country_id"])){
   //Get all state data
  $country_id= $_POST['country_id'];
   $query = "SELECT * FROM states WHERE country_id = '$country_id' 
  ORDER BY state_name ASC";
  $run_query = mysqli_query($con, $query);
   
   //Count total number of rows
   $count = mysqli_num_rows($run_query);
   
   //Display states list
   if($count > 0){
       echo '<option value="">Select state</option>';
       while($row = mysqli_fetch_array($run_query)){
     $state_id=$row['state_id'];
     $state_name=$row['state_name'];
       echo "<option value='$state_id'>$state_name</option>";
       }
   }else{
       echo '<option value="">State not available</option>';
   }
}

if(isset($_POST["state_id"])){
  $state_id= $_POST['state_id'];
   //Get all city data
   $query = "SELECT * FROM cities WHERE state_id = '$state_id' 
  ORDER BY city_name ASC";
   $run_query = mysqli_query($con, $query);
   //Count total number of rows
   $count = mysqli_num_rows($run_query);
   
   //Display cities list
   if($count > 0){
       echo '<option value="">Select city</option>';
       while($row = mysqli_fetch_array($run_query)){
     $city_id=$row['city_id'];
     $city_name=$row['city_name']; 
       echo "<option value='$city_id'>$city_name</option>";
       }
   }else{
       echo '<option value="">City not available</option>';
   }
}
?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Important Note</h4>
      </div>
      <div class="modal-body">
        <div id="msg">
          <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
          So Chart are given below :-  
          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th>Package Name</th>
                <td>Bronze</th>
                <td>Silver</th>
                <td>Gold</th>
                <td>Diamond</th>
                <td>Platinum</th>
                <td>Platinum+</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Minimun Order</th>
                <td>1750</td>
                <td>5000</td>
                <td>10,000</td>
                <td>20,000</td>
                <td>50,000</td>
                <td>1,00,000</td>
              </tr>
              <tr>
                <th>Discount</th>
                <td>250</td>
                <td>500</td>
                <td>1000</td>
                <td>2000</td>
                <td>5000</td>
                <td>10,000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">

  $(document).ready(
    function getInfo() {
      
      <?php
        $sesData = $this->session->userdata('web_logged_in'); 
        $value = $sesData['id'];
      ?>
      // print_r();exit;
      var valueOfSession = '<?php echo $value; ?>';
      // alert(valueOfSession);
      if (valueOfSession != '') 
      {
        
        $.ajax({
          url: '<?php echo site_url("website1/CheckOut/getInfo"); ?>',
          type: "POST",
          data: {
              "session_id"    : valueOfSession,
              "total_amount"  : $('#total_amount').val(),
          },
          success: function (response) {
            var arr = response.split(" ");
            console.log(arr[0]);
            console.log(response);
            if (response == '') {
              $('#myModal').modal('show');
            }else{
              if (arr[0] == '0') 
              {
                $('#msg').html('<div>You don\'t have any package ,Please purchase any package and take advantange of Shopping.</div><table class="table table-bordered mt-4"><thead><tr><th>Package Name</th><th>Bronze</th><th>Silver</th><th>Gold</th><th>Diamond</th><th>Platinum</th><th>Platinum+</th></tr></thead><tbody><tr><th>Minimun Order</th><td>3000</td><td>5000</td><td>10,000</td><td>20,000</td><td>50,000</td><td>1,00,000</td></tr><tr><th>Discount</th><td>250</td><td>500</td><td>1000</td><td>2000</td><td>5000</td><td>10,000</td></tr></tbody></table>');
                $('#myModal').modal('show');
              } 
              else if (arr[0] == '1') 
              {
                $('#msg').html('<div>You don\'t have any package ,Please purchase any package and take advantange of Shopping.</div><table class="table table-bordered mt-4"><thead><tr><th>Package Name</th><th>Bronze</th><th>Silver</th><th>Gold</th><th>Diamond</th><th>Platinum</th><th>Platinum+</th></tr></thead><tbody><tr><th>Minimun Order</th><td>3000</td><td>5000</td><td>10,000</td><td>20,000</td><td>50,000</td><td>1,00,000</td></tr><tr><th>Discount</th><td>250</td><td>500</td><td>1000</td><td>2000</td><td>5000</td><td>10,000</td></tr></tbody></table>');
                $('#myModal').modal('show');
              }
              else if (arr[0] == '2') 
              {
                $('#msg').html('<div>You don\'t have any package ,Please purchase any package and take advantange of Shopping.</div><table class="table table-bordered mt-4"><thead><tr><th>Package Name</th><th>Bronze</th><th>Silver</th><th>Gold</th><th>Diamond</th><th>Platinum</th><th>Platinum+</th></tr></thead><tbody><tr><th>Minimun Order</th><td>3000</td><td>5000</td><td>10,000</td><td>20,000</td><td>50,000</td><td>1,00,000</td></tr><tr><th>Discount</th><td>250</td><td>500</td><td>1000</td><td>2000</td><td>5000</td><td>10,000</td></tr></tbody></table>');
                $('#myModal').modal('show');
              }
              else if (arr[0] == '4') 
              {
                $('#msg').html('<div>You don\'t have any package ,Please purchase any package and take advantange of Shopping.</div><table class="table table-bordered mt-4"><thead><tr><th>Package Name</th><th>Bronze</th><th>Silver</th><th>Gold</th><th>Diamond</th><th>Platinum</th><th>Platinum+</th></tr></thead><tbody><tr><th>Minimun Order</th><td>3000</td><td>5000</td><td>10,000</td><td>20,000</td><td>50,000</td><td>1,00,000</td></tr><tr><th>Discount</th><td>250</td><td>500</td><td>1000</td><td>2000</td><td>5000</td><td>10,000</td></tr></tbody></table>');
                $('#myModal').modal('show');
              }
              else if (arr[0] == '3') 
              {
                $('#total_amount').val(parseInt($('#total_amount').val()) - parseInt(arr[1]));

                $('#strongg').text(parseInt($('#total_amount1').val()) - parseInt(arr[1]));
                $('#msg').html('Congratulation! you save Rs.'+arr[1] +' of this purchase. Enjoy Shopping with Small Bazar and take advantage for Shopping. Thanks for Shopping');
                $('#myModal').modal('show');
              }else{
                $('#myModal').modal('show');
              }
            }
          }
      });
      }
    }
  );

  $(document).ready(function getState(country_id){
      $.ajax({
          url: '<?php echo site_url("website1/CheckOut/getState"); ?>',
          type: "POST",
          data: {
              "country_id" : 101
          },
          success: function (response) {

              if (response == '0') 
              {
                  $('#state').html('<option value="0">Select State</option>');
              } 
              else 
              {
                  var obj = JSON.parse(response);
                  // console.log(obj.length);
                  var html = '';
                  for(var i=0; i<obj.length; i++){
                      // console.log(obj[i]['id']);
                      html += '<option value="'+obj[i]['id']+'">'+obj[i]['state_name']+'</option>'
                  }
                  // console.log(html);
                  $('#state').html(html);
                  // $('#state').niceSelect('update');

              }
          }
      });
  });
  function getCity(state_id)
  {
      $.ajax({
          url: '<?php echo site_url("website1/CheckOut/getCity"); ?>',
          type: "POST",
          data: {
              "state_id" : state_id
          },
          success: function (response) {

              if (response == '0') 
              {
                  $('#city').html('<option value="0">Select State</option>');
              } 
              else 
              {
                  var obj = JSON.parse(response);
                  // console.log(obj.length);
                  var html = '';
                  for(var i=0; i<obj.length; i++){
                      // console.log(obj[i]['id']);
                      html += '<option value="'+obj[i]['id']+','+obj[i]['city_name']+'">'+obj[i]['city_name']+'</option>'
                  }
                  $('#city').html(html);
                  $('#city').niceSelect('update');
              }
          }
      });
  }
  function checkPostalCode(postalCode)
  {
    //  alert('yes');
    var city = $('#city').val();
    var nameArr = city.split(',');
    //alert(city);
    //alert(nameArr);
    //alert(postalCode);
    // console.log(nameArr);
    var status = 0;
    $.ajax({
      url: "https://api.postalpincode.in/pincode/"+postalCode,
      type: "GET",
      
      success: function (response) {
        // console.log(response.length);
        for (var i = 0; i < response.length; i++){
        // look for the entry with a matching `code` value
        //  alert(response[i]['PostOffice'][j].Block);
          if (response[i]['PostOffice'] != null ) {
            for (var j = 0; j <= response[i]['PostOffice'].length; j++) {
              // console.log(response[i]['PostOffice'][j].District);
              if (response[i]['PostOffice'][j].District == nameArr[1]){
                // console.log('yes');
                $('#err_pin').html('');
                      document.getElementById("proceed").disabled = false;
                      break;
              }
              else
              {
               console.log('No');
               $('#err_pin').html('<span style = "color : red" > Please enter valid pincode </span>');
                          $('#proceed').attr('disabled','disabled');
              }
            }
          }
          else
          {
            // console.log('No');
            $('#err_pin').html('<span style = "color : red" > Please enter valid pincode </span>');
            $('#proceed').attr('disabled','disabled');
          }
        }  
       //  for (var i = 0; i < response.length; i++) {
       //    // console.log(response[i]['PostOffice']);
       //    // console.log(response[i]['PostOffice'].length);
       //    if (response[i]['PostOffice'] != null ) {
       //      for (var j = 0; j <= response[i]['PostOffice'].length; j++) {
       //        // console.log(response[i]['PostOffice'][j].Block);
       //        var city_name = response[i]['PostOffice'][j].Block;
       //        // alert(city_name)
       //        if (nameArr[1] !== city_name) {
       //          status = 1;
       //          break;
       //        }else{
       //          status = 0;
       //        }
       //      }
       //      if (status == 1) {
       //        $('#err_pin').html('<span style = "color : red" > Please enter valid pincode </span>');
       //        $('#proceed').attr('disabled','disabled');
       //        break;
       //      }else{
       //        $('#err_pin').html('');
       //        document.getElementById("proceed").disabled = false;
       //      }
       //    }
       //  }
      }
    });
  }
</script>