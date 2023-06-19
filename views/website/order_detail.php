<section class="find-normal-section content-wishlist-box shadow m-5">
    <div class="container-fluid">
        <div class="checkout-area  p-3">
           <div class="row">
			<div class="col-md-12 mb-2">
				<h3>Order Received</h3>
				<strong>Thank you. Your order has been received.</strong>
			</div>
			<div class="col-md-12">

				<ul class="order_details">

				<li >
					Order number: <strong><?php echo $order_id ; ?></strong>
				</li>

				<li >
					Date:<strong><?php echo $date ; ?></strong>
				</li>

				
				<li >
					Total:<strong><span ><span ><i class="fas fa-rupee-sign"></i></span> <?php echo $total_price ; ?></span></strong>
				</li>

				<li >
						Order Status:	<strong><?php 
						if ($payment_status == 0) {
							echo 'PENDING' ;
						}else if ($payment_status == 1){
							echo 'COMPLETE' ;
						}else if ($payment_status == 2){
							echo 'DISPATCH' ;
						}else{
							echo "CANCEL";
						}

					 ?></strong>
				</li>
				
				</ul>
				
			</div>	
		</div>
    	</div>
    	<div class="container">
            <div class="wishlist-area">
               <div class="">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 ">
                     	<h4>Order Detail</h4>
                        <div class="wishlist-content">
                            <form action="#">
                            	<div class="wishlist-table table-responsive">
                                 	<table>
	                                    <thead>
	                                      <tr>
	                                        <th class="product-quantity">Product</th>
	                                        <th class="product-price">Price</th>
	                                      </tr>
	                                    </thead>
                                    	<tbody>
                                      		<?php foreach ($cart as $key => $value) { ?>
		                                      	<tr>
		                                          	<td class="product-name">
		                                        		<img width="50" height="50" src="<?php echo $value['product_image']; ?>">&nbsp;&nbsp;
		                                          		<?php echo $value['product_name'].' * '. $value['quantity']; ?>
		                                          	</td>
		                                          	<td class="product-quantity">RS.<?php echo $value['price']; ?></td>
		                                      	</tr>
                                      		<?php } ?>
                                    	</tbody>
                                  	</table>
                              	</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>

	
</section>