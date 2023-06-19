<style type="text/css">
   

</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Booking</li>
			<li></li>
		</ol> 			
	</div>
	<style type="text/css">
		.product-img
		{
			width: 40%;
			float: left;
		}
		.product-content p {
			        padding-top: 0 !important;
				    margin-bottom: 2px;
				    font-size: 14px;
				    color: #abb7bb;
				}
		.product-content
		{
			width: 60%;
			float: left;
			padding-left:14px; 
		}
		.product-content span
		{
 		color: #6b6b6b;
	    font-weight: bold;
	    }
	   .product-content + .desc
	   {
	   	 display: inline-block;
	   	 width: 100%;
	   	 margin-top: 20px;
	   }
	   .product-content + .desc span {
		    color: #6b6b6b;
		    font-weight: bold;
		}
		.product-content + .desc p {
    padding-top: 0 !important;
    margin-bottom: 2px;
    font-size: 14px;
    color: #abb7bb;
}
	</style>
    <!-- /. PAGE INNER  -->
    <div id="page-inner" class="card-item">
    	<div class="contenar">
    		<div class="col-sm-12">
				<?php
    				// print_r($data);
    				if (!empty($data)) {
    					for ($i=0; $i < count($data); $i++) { 
    						if ($data[$i] != '') {
    							// print_r($data[$i]); 
    			?>
				<div class="col-sm-6">
					<div class="well">
					  	<div class="product-img">
					  	   	<img src="<?php echo $data[$i]['product_image']; ?>" width="100%" height="144">
					  	</div>
					  	<div class="product-content">
							<div>
								<span>Name</span>
								<p><?php echo $data[$i]['product_name']; ?></p>	
							</div>
							<div>
								<span>Price</span>
								<p>Rs. <?php echo $data[$i]['actual_price']; ?></p>	
							</div>
							<div>
								<span>Quantity</span>
								<p><?php echo $data[$i]['quantity']; ?></p>	
							</div>
					  	</div>
						<div class="desc">
							<span>Description</span>
							<p><?php echo $data[$i]['product_description']; ?></p>	
						</div>
					</div>
				</div>
    			<?php } else{ ?>
    				
					<div class="col-sm-12">
    					<div class="col-sm-6 well">
						  	<div class="product-content">
								No Data Found
						  	</div>
						</div>
    				</div>
				<?php }
    				} 
    			}else{ ?>
    				<div class="col-sm-12">
    					<div class="col-sm-6 well">
						  	<div class="product-content">
								No Data Found
						  	</div>
						</div>
    				</div>
    			<?php }
    			?>
    		</div>
    	</div>
    </div>


           
                <!-- <img src="http://lorempixel.com/400/400/cats/3" alt="Cats"/> -->
           

<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    
</script>