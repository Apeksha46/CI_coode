<?php
   $wishes = $this->CommonModel->selectRowDataByCondition(array('wishes_id' => '1','active_status' => 'enable'),'wishes');
   if(!empty($wishes)){
?>

   <section class="banner-diwali">
      <div class="container-fluid">
       <div class="row">
         <div class="col-md-12 d-flex justify-content-center align-items-center ">
            <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="bomb-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
               <div class="normal-rocket"></div>
            <h2 class="text">
              <?php echo $wishes->text_msg; ?>
            </h2>
         </div>
       </div>
       </div>
   </section>
<?php
   }

   $sliderData = $this->CommonModel->selectAllResultData('slider');
   if (!empty($sliderData)) {
      $i = 0;
      $count = (int)count($sliderData) + (int)2; ?>
      <section class="banner-slider">
         
         <div id="slider-animation1" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
               <?php 
                  for ($i=0; $i < $count; $i++) { 
                     if ($i == 0) { ?>
                        <li data-target="#slider-animation1" data-slide-to="<?php echo $i; ?>" class="active"></li>
                     <?php }else{ ?>
                        <li data-target="#slider-animation1" data-slide-to="<?php echo $i; ?>"></li>
                     <?php
                     }
                  } 
               ?>
            </ul>
            <div class="carousel-inner">

         <?php
            $j = 0;
         foreach ($sliderData as $key => $values) { 
            $j++;
            if ($j == 1) { ?>
               <div class="carousel-item active slider">
                  <img class="img-fluid" src="<?php echo base_url().'assets/img/slider.jpg'; ?>">
                  <div class="slider_gif">
                    <img src="<?php echo base_url().'assets/img/flag.gif'; ?>">
                  </div>  
               </div>
               <div class="carousel-item ">
                  <img class="img-fluid" src="<?php echo base_url().'assets/img/slider_package_image.png'; ?>">
               </div>
               <div class="carousel-item ">
                     <img src="<?php echo base_url().'slider/'.$values['slider_img']; ?>" alt="Los Angeles">
                     <div class="carousel-caption ">
                        <div>
                           <h2 class=" "><?php echo $values['slider_title']; ?></h2>
                           <p ><?php echo $values['slider_desc']; ?></p>
                        
                     </div>
                  </div>
               </div>
            <?php }else{ ?>
                  <div class="carousel-item ">
                     <img src="<?php echo base_url().'slider/'.$values['slider_img']; ?>" alt="Los Angeles">
                     <div class="carousel-caption ">
                        <div>
                           <!-- <h6>MID-SEASON</h6> -->
                           <h2 class=" "><?php echo $values['slider_title']; ?></h2>
                           <p ><?php echo $values['slider_desc']; ?></p>
                           
                        </div>
                     </div>
                  </div>
            <?php }
          ?>
               <!-- The slideshow -->
               
                  
            <?php } ?>
            <!-- </div> -->
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#slider-animation1" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slider-animation1" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
         </div>
      </section>
<?php  
   }
?>

<section class="pt-5 pb-5 package-tab">
 <div class="container-fluid">
  
   <div class="row">
      <div class="col-12 ">
          <ul class="nav nav-tabs nav-stacked text-center" role="tablist">
                <li role="presentation" class="active"><a href="#package1" aria-controls="package1" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo" ><span> Bronze</span></a></li>
                <li role="presentation"><a href="#package2" aria-controls="package2" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo" ><span> Silver</span></a></li>
                <li role="presentation"><a href="#package3" aria-controls="package3" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo"><span> Gold</span></a></li>
                <li role="presentation"><a href="#package4" aria-controls="package4" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo" ><span> Diamond  </span></a></li>
                <li role="presentation"><a href="#package5" aria-controls="package5" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo" ><span> Platinum</span></a></li>
                <li role="presentation"><a href="#package6" aria-controls="package6" role="tab" data-toggle="tab"><img src="http://3.16.159.2/small_bazar/assets/img/logo.png" alt="logo" ><span> Titanium</span></a></li>
            </ul>
      </div>
        <div class="col-12 ">
         <div class="pt-4 pb-4 bg-light">
            <h2>Benifit</h2>
         </div>
            <div class=" tab-content">
               <div role="tabpanel" class="tab-pane  active in" id="package1">
                     
                   <div>
                     <div id="msgs">
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
               </div>
               <div role="tabpanel" class="tab-pane " id="package2">
                   <div>
                     <div id="msgs">
                        
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
               </div>
               <div role="tabpanel" class="tab-pane " id="package3">
                   <div>
                     <div id="msgs">
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
               </div>

               <div role="tabpanel" class="tab-pane " id="package4">
                    <div>
                     <div id="msgs">
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
               </div>

               <div role="tabpanel" class="tab-pane " id="package5">
                    <div>
                     <div id="msgs">
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
               </div>

               <div role="tabpanel" class="tab-pane " id="package6">
                    <div>
                     <div id="msgs">
                         <strong>Note :</strong>&nbsp;&nbsp;&nbsp; If your purchase any package either it will Brounce,Silver,Gold,Platinum, So Small Bazar provide <strong>Coupon</strong> for their user.
                         So Chart are given below :-  
                         <table class="table table-bordered mt-4">
                           <thead>
                             <tr>
                               <th>Package Name</th>
                               <th>Bronze</th>
                               <th>Silver</th>
                               <th>Gold</th>
                               <th>Diamond</th>
                               <th>Platinum</th>
                               <th>Titanium</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th>Minimun Order</th>
                               <td>3000</td>
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
                </div>
            </div>
      </div>
   </div>
</div>
</section>

<section class="top-selling-product pt-5">
   <div class="container-fluid">
   <div class="row">
      <div class="col-md-12 content-titel text-center pb-5">
         <h2>Top Selling</h2>
      </div>
         <?php  $i=1; foreach ($product as $key)  { ?>
      <div class="col-md-3 col-sm-6">
            <div class="product-grid5">
               <div class="product-image5">
                  <!-- <a href="#"> -->
                  <img class="pic-1" src="<?php echo $key['image']; ?>">
                  <!-- </a> -->
               </div>
               <div class="product-content">
                  <h3 class="title">
                     <!-- <a href="#"> -->
                     <input type="hidden" value="<?php echo $key['product_id']; ?>" id="product_id">
                     <?php echo $key['product_name']; ?>
                  </h3>
                  <div class="price ">₹ <?php echo $key['price']; ?></div>
                  <span></span>
                  <a class="btn view" onclick="viewModal('<?php echo $key['product_id']; ?>');"> view</a>
                  <?php if (!empty($id)) { ?>
                     <button type="button" onclick="addToCart('<?php echo $key['product_id']; ?>');" class="btn">Add to cart</button>
                  <?php }else{ ?>
                     <button type="button" data-toggle="modal" data-target="#myModalLoginFirst" class="btn">Add to cart</button>
                  <?php } ?>
               </div>
            </div>
      </div>
         <?php } ?>
   </div>
</section>
<!-- Modal -->
<div class="modal fade sign-in" id="vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         <div class="modal-body">
            <form action="#" method="POST">
               <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                  <div class='carousel-outer'>
                     <!-- me art lab slider -->
                     <div class='carousel-inner '>
                        <div id="product_img">
                        </div>
                     </div>
                     <!-- sag sol -->
                     <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                     <span class='glyphicon glyphicon-chevron-left'></span>
                     </a>
                     <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                     <span class='glyphicon glyphicon-chevron-right'></span>
                     </a>
                  </div>
                  <!-- thumb -->
                  <ol class='carousel-indicators mCustomScrollbar meartlab' id="pr_img">
                  </ol>
               </div>
               <div class="d-box">
                  <div class="form-box form-ui">
                     <input type="hidden" id="p_id" name="p_id">
                     <!--  <div id="pr_img">
                        </div> -->
                     <div class="col-md-12">
                        <label class="label-dark"> <strong>Product Name :- <strong> </label>
                        <input type="text" name="p_name" class="form-control" id="p_name" readonly="">
                     </div>
                     <div class="col-md-12">
                        <label class="label-dark">Product Price :- </label>
                        <div class="d-flex" id="dis">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <label class="label-dark">About Product :- </label>
                        <textarea class="form-control"  name="textarea" id="p_desc" readonly="">default text</textarea>
                        <!-- <input type="text" name="p_desc" class="form-control" id="p_desc" readonly> -->
                     </div>
                  </div>
               </div>
               <!-- <div id="enable" class="mt-2">
                  </div> -->
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal " id="myModal" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <!-- <h4 class="modal-title">Modal Heading</h4> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
        
         <!-- Modal body -->
         <div class="modal-body">
            <div id="msg"></div>
         </div>
        
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div class="modal " id="myModalLoginFirst" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <!-- <h4 class="modal-title">Modal Heading</h4> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
        
         <!-- Modal body -->
         <div class="modal-body">
            <div id="">Please login first</div>
         </div>
        
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<div class="modal bd-example-modal-sm" id="myWonModal" data-keyboard="false" data-backdrop="static"  aria-labelledby="mySmallModalLabel">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <!-- <h4 class="modal-title">Modal Heading</h4> -->
            <button type="button" onclick="wonStatusChange();" class="close" data-dismiss="modal">&times;</button>
         </div>
        
         <!-- Modal body -->
         <div class="modal-body refer-bg">
            <div class="refer-earn"><p>Congratulations you earn</p>
            <p> <small><i class="fas fa-rupee-sign"></i></small> <strong>51 </strong></p> </div>
         </div>
        
      </div>
   </div>
</div>





<script type="text/javascript">
   
   $( document ).ready(function() {
      
      checkWonStatus();
   });

   function viewModal(val) 
    {
      var product_id =  val;
      // console.log(product_id);
      $.ajax({

         url: '<?php echo site_url("website1/CheckOut/getProduct"); ?>',
         type: "POST",
         data: {
             "product_id" : product_id
         },
         success: function (response) 
         {
            var html = '';
            var htm = '';
            var obj = JSON.parse(response);
            // console.log(obj.image.length);
             $('#p_id').val(obj.product_id);
            $('#p_name').val(obj.product_name);
            $('#p_desc').val(obj.product_description);
            $('#p_price').val(obj.price);
            $('#discount_price').val(obj.discount_price);
            // console.log(obj.discount_price);
            if (obj.discount_price != 0) {
               $('#dis').html('<span class="rs-text"> RS</span>'+obj.price+' </span>');
            }else{
               $('#dis').html('<span class="rs-text"> RS</span> '+obj.price+' ');
            }
            // $('#p_product_quantity').val(obj.product_quantity);
            // console.log(obj.product_quantity);
            if (obj.remaining_quantity == '0') {
               $('#enable').html('<a class="btn btn-block">Out of Stock</a>');
            }else{
               $('#enable').html('<button type="submit" class="btn  btn-block">Proceed</button>');
            }
            var url = "<?php echo base_url(); ?>";
            // console.log(obj.image.length);
            if (obj.image.length != 0) {
               for (var i = 0; i < obj.image.length; i++) 
               {
                  var tem = url +'product/'+obj.image[i]['image'];
                  // html +=  '<img src = "'+tem+'" height= 150px width = 150px >'
                  html +=  '<li data-target="#carousel-custom" data-slide-to="'+i+'" class="active"><img src="'+tem+'"  /></li>';
                  if (i == 0) {

                     htm += '<div class="carousel-item active"><img src="'+tem+'" id="zoom_05"  data-zoom-image="'+tem+'"/></div>';
                  }else{

                     htm += '<div class="carousel-item"><img src="'+tem+'" id="zoom_05"  data-zoom-image="'+tem+'"/></div>';
                  }
               }
               $('#product_img').html(htm);
               $('#pr_img').html(html);
            }else{
               $('#product_img').html('');
               $('#pr_img').html('');

            }
         }
     });
    $('#vehicle').modal('show');
  }
   function addToCart(id)
   {
      $.ajax({
         url: '<?php echo site_url("website1/CheckOut/addToCart"); ?>',
         type: "POST",
         data: {
             "product_id" : id
         },
         success: function (response_data) 
         {
            console.log(response_data);
            if (response_data == 1) {
               $('#msg').text('Product added successfully');
               $('#myModal').modal('show');
               // alert('item added into cart successfully');
            }else if (response_data == 2) {
               $('#msg').text('Product already into your cart');
               $('#myModal').modal('show');
               // alert('item added into cart successfully');
            }else{
               $('#msg').text('Sorry! Product not added into yout cart,Please try again.');
               $('#myModal').modal('show');
               // alert('item not added into cart');
            }
         }
     });
   }

   function checkWonStatus()
   {
      var id = '<?php echo $id; ?>';
      // alert(id);
      if (id != '') {
        $.ajax({
           url: '<?php echo site_url("website1/Auth/checkWonStatus"); ?>',
           type: "POST",
           data: {
               "id" : id
           },
           success: function (response_data) 
           {
            console.log(response_data);
            // alert(response_data);
              if (response_data == 0) {
                 $('#myWonModal').modal('show');
              }
           }
       });
      }
   }

   function wonStatusChange()
   {
      var id = '<?php echo $id; ?>';
      // alert(id);
      $.ajax({
         url: '<?php echo site_url("website1/Auth/wonStatusChange"); ?>',
         type: "POST",
         data: {
             "id" : id
         },
         success: function (response_data) 
         {
            
         }
     });
   }
</script>