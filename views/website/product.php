<section class="top-selling-product pt-5 pb-5">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-12 ">
            <form method="post" action="<?php echo base_url().'website/Product/index/'.$this->uri->segment(4); ?>">
                    <!-- widget-categories start -->
               <aside class="widget widget-categories">
                   <div id="custom-search-input">
                     <div class="input-group ">
                        
                        <input type="text" name="search" class="  search-query form-control" placeholder="Search by Product Name" />
                        <!-- <button class="btn " type="button"> -->
                           <!--    <span class=" glyphicon glyphicon-search"></span> -->
                           <!-- <i class="fas fa-search"></i> -->
                        <!-- </button> -->
                     </div>
                   </div>
                </aside>
               <!-- widget-categories start -->
               <aside class="widget widget-categories">
                     <h3 class="sidebar-title">Sub-Categories</h3>
                     <ul class="sidebar-menu checkbox-content-box scrollbar">
                        <?php
                           if (!empty($sub_category)) {
                              $i = 0;
                              foreach($sub_category as $key => $value){ 
                                 $i = $i+1; ?>
                                 <li>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input <?php if($this->uri->segment(5) == $value['sub_category_id']){ echo "checked"; }else{ echo ""; } ?> type="checkbox" class="form-check-input" value="<?php echo $value['sub_category_id']; ?>" name="sub_cat[]"><?php echo $value['sub_category_name']; ?>
                                      </label>
                                    </div>
                                 </li>

                        <?php }
                           }
                        ?>
                     </ul>
                  </aside>
           
                  <aside class="widget widget-categories pt-3">
                     <h3 class="sidebar-title">Sort By</h3>

                     <ul class=" sidebar-menu mt-3 mb-3 ">
                              <li>
                                 <div class="noti-check-wrap mt-3 ">
                                    <input type="radio" name="sort" id="sortby1" value="desc">
                                    <label for="sortby1" class="noti-label">
                                       High to Low
                                    </label>
                                 </div>
                              </li>
                              <li>
                                 <div class="noti-check-wrap mb-3">
                                    <input type="radio" name="sort" id="sortby2" value="asc" checked="">
                                    <label for="sortby2" class="noti-label" >
                                   Low to High
                                    </label>
                                 </div>
                              </li>
                           </ul>
                  </aside>
                  
            
               <!-- shop-filter start -->
               <aside class=" shop-filter pt-3">
                  <h3 class="sidebar-title">Filter selection</h3>
                  <div class="info_widget">
                     <div class="price_filter">
                        <div id="slider-range"></div>
                        <div class="price_slider_amount">
                           <div class="slider-container">
                              <!-- <input type="text" id="slider3" class="slider" /> -->
                              <input type="text" class="js-range-slider" name="my_range" value=""/>  
                           </div>
                           <!-- <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                              <input type="submit"  value="Filter"/> -->
                        </div>
                     </div>
                  </div>
               </aside>
               <!-- shop-filter end -->
               <!-- widget-categories start -->
               <aside class="widget widget-categories">
                
                   <div class="mt-3">
                     <input type="hidden" id="split_start_price_range" name="split_start_price_range"/>
                     <input type="hidden" id="split_end_price_range" name="split_end_price_range"  />
                     <button type="submit" class="btn btn-block"> Submit</button>
                   </div>
               </aside>
               <!-- widget-categories end -->
            </form> 
            
            
         </div>
        
         <div class="col-md-9 shadow">
          <div class=" content-titel text-center pb-5 pt-3">
            <!-- <h2>Package List</h2> -->

         </div>
         <div class="row">
         <?php  $i=1;
            if (!empty($product)) {
               foreach ($product as $key)  { ?>
            
            <div class="col-md-4 col-sm-6">
               <div class="product-grid5">
                  <div class="product-image5">
                   
                     <input type="hidden" id="product_id" name="product_id" value="<?php echo $key['product_id']; ?>">
                     <img class="img-table-modal view" onclick="viewModal('<?php echo $key['product_id']; ?>')" src="<?php echo $key['image']; ?>">
                    
                  </div>
                  <div class="product-content">
                     <h3 class="title ">
                        <a href="#"><?php echo $key['product_name']; ?>
                        <!-- <br> -->
                        <?php 
                        // echo $key['product_description']; 
                        ?>
                        </a>
                     </h3>
                     <div class="price ">₹ <?php echo $key['price']; ?></div>
                     <a class="btn view" onclick="viewModal('<?php echo $key['product_id']; ?>');"> view</a>

                     
                     <!-- <span>Shirts</span> -->
                     <!-- <a href="product-view.html" class="btn"> view</a> -->
                     <form method="post" action="<?php echo site_url('website/CheckOut/index/');?>">
                        <input type="hidden" id="product_id" name="product_id" value="<?php echo $key['product_id']; ?>">
                        <input type="hidden" id="product_name" value="<?php echo $key['product_name']; ?>">
                        <input type="hidden" id="product_description" value="<?php echo $key['product_description']; ?>">
                        <input type="hidden" id="price" value="<?php echo $key['price']; ?>">
                        <div class="">
                           <?php if (!empty($id)) { ?>
                              <button type="button" style="margin-top: -43px;margin-left: 130px;" onclick="addToCart('<?php echo $key['product_id']; ?>');" class="btn">Add to cart</button>
                           <?php }else{ ?>
                              <button type="button"  style="margin-top: -43px;margin-left: 130px;" data-toggle="modal" data-target="#myModal" class="btn">Add to cart</button>
                           <?php } ?>
                           <!-- <button type="button" onclick="addToCart('<?php echo $key['product_id']; ?>');" class="btn float-right">Add to cart</button> -->
                           
                        </div>
                     </form>
                  </div>
               </div>
            </div>
           
       
         <?php $i++; 
            }    
            }else{ ?>
         <img style="margin-left: 35%;" src="<?php echo base_url().'assets/img/no_data_found.jpg'; ?>">
         <?php } ?>
          </div>
      </div>
   </div>
</section>
<!-- Modal -->
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
         </div>
         <div class="modal-body">
            <img data-toggle="modal" id="modelImg" data-target="#image-modal"  class="img-responsive m-auto"   src="">
         </div>
      </div>
   </div>
</div>

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
<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <!-- <h4 class="modal-title">Modal Heading</h4> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
        
         <!-- Modal body -->
         <div class="modal-body">
            <div id="msg">Please login first</div>
         </div>
        
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function addToCart(id)
   {
      $.ajax({
         url: '<?php echo site_url("website/CheckOut/addToCart"); ?>',
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
   
   function changeImgUser(img)
   {
      // var base_url = '<?=base_url().'uploads/userImg/'?>' ;
      // var imgTag = base_url+img;
      var imgTag = img;
      $("#modelImg").attr("src",imgTag);
   }
   
   //edit the unit name
      function viewModal(val) 
      {
            var product_id =  val;
            console.log(product_id);
            $.ajax({
   
               url: '<?php echo site_url("website/CheckOut/getProduct"); ?>',
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
                     $('#dis').html('<span class="rs-text"> RS</span> <strike>'+obj.price+' </strike> '+obj.discount_price+ ' </span>');
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
   
</script>