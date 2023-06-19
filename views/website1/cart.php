 <section>
         <div class="page-title-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-heading ">
                     <h1>My Order</h1>
                     <p>We are a featured brand that calls itself fashion</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </section>
      <section>
         <div class="container">
            <div class="wishlist-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 ">
                  <div class="wishlist-content">
                     <form action="#">
                        <div class="wishlist-table table-responsive">
                           <table>
                              <thead>
                                <tr>
                                  <th class="product-thumbnail">Image</th>
                                  <th class="product-name">Product</th>
                                  <th class="product-price">Price</th>
                                  <th class="product-price">Quantity</th>
                                  <th class="product-remove"> Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $i = 0;
                                  foreach ($cart as $key => $value) { 
                                    $i = $i+1;
                                  ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="<?php echo $value['product_image']; ?>" height="50px" width="50px">
                                    </td>
                                    <td class="product-name"><?php echo $value['product_name']; ?></td>
                                    <td class="product-quantity">
                                      <input type="hidden" id="price_calculate_<?php echo $i; ?>" value="<?php echo $value['actual_price']; ?>">
                                      <span id="price_<?php echo $i; ?>"><?php echo $value['price']; ?></span></td>
                                    <td class="product-quantity">
                                      <a href="#" onclick="minus(<?php echo $i; ?>,'<?php echo $value["cart_id"]; ?>');"><span id="minus"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                                      <span id="qty_<?php echo $i; ?>"><?php echo $value['quantity']; ?></span>
                                      <a href="#" onclick="plus(<?php echo $i; ?>,'<?php echo $value["cart_id"]; ?>');"><span id="plus"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                                        
                                    </td>
                                    <td>
                                      <a class="btn " onclick="delteFunction('<?php echo $value["cart_id"] ;?>')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                        <br/>
                        <a style="float: right;" class="btn" href="<?php echo base_url().'website1/CheckOut/checkout'; ?>" name="submit">CheckOut</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
         </div>
      </section>
      <script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    function plus(i,cart_id)
    {
      var qty_val = $('#qty_'+i).text();
      var val = parseInt(qty_val) + parseInt(1)
      $('#qty_'+i).text(val);
      var price = parseInt(val) * parseInt($('#price_calculate_'+i).val());
      $('#price_'+i).text(price);
      $.ajax({
        url: '<?php echo site_url("website1/CheckOut/update_qty_price"); ?>',
        type: "POST",
        data: {
            "cart_id" : cart_id,
            "qty"     : val,
            "price"   : price
        },
        success: function (response) {
            
        }
      });
      // alert(qty_val)
    }
    function minus(i,cart_id)
    {
      var qty_val = $('#qty_'+i).text();
      var val     = parseInt(qty_val) - parseInt(1);
      var price   = parseInt(val) * parseInt($('#price_calculate_'+i).val());
      if (val == 0) {
        alert('atleast 1 quantity is required ');
      }
      if (val > 0) {
        $('#qty_'+i).text(val);
        $('#price_'+i).text(price);
        $.ajax({
          url: '<?php echo site_url("website1/CheckOut/update_qty_price"); ?>',
          type: "POST",
          data: {
              "cart_id" : cart_id,
              "qty"     : val,
              "price"   : price
          },
          success: function (response) {
              
          }
        });
      }
    }
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("website1/CheckOut/delete_cart"); ?>',
                type: "POST",
                data: {
                    "cart_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Category!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Category!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>