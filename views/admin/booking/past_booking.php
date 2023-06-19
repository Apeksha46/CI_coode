<style type="text/css">
   

</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Past Booking</li>
			<li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner" class="booking">
        <!-- Tab panes -->
        <div class="tab-content">
                <h2>Booking</h2>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                      <a href="#pending_past" role="tab" data-toggle="tab">
                          <i class="fa fa-clock-o" ></i>
                          Pending Booking
                      </a>
                    </li>
                    <li class="">
                      <a href="#dispatch_past" role="tab" data-toggle="tab">
                          <i class="fa fa-clock-o" ></i>
                          Dispatch Booking
                      </a>
                    </li>
                    <li><a href="#complete_past" role="tab" data-toggle="tab">
                        <i class="fa fa-check"></i>
                      Complete Booking
                      </a>
                    </li>
                    <li>
                    	<a href="#cancel_past" role="tab" data-toggle="tab">
                        	<i class="fa fa-times"></i>
                      		Cancel Booking
                      	</a>
                    </li>
                    <li>
                    	<a href="#return_past" role="tab" data-toggle="tab">
                        	<i class="fa fa-exchange"></i>
                      		Return Booking
                      	</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                	 <!-- <?php echo "<pre>"; print_r(count($accept)); ?>  -->
                	 <!-- <?php echo "<pre>"; print_r(count($pending)); ?>   -->
                  	<div class="tab-pane fade in active" id="pending_past">
                      	<div class="row">
				            <div class="col-md-12">
				                
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="start_date0">
				                </div>
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="end_date0">
				                </div>
				                <div class="col-md-2">
				                    <button type="button" class="btn btn-primary" onclick="filterPendingPastBookingData();">Submit</button>
				                </div>
				            </div>
				        </div>
	                     <div class="table-responsive">
	                     	<table class="table table-striped table-bordered table-hover tableExport">
								<thead>
									<tr>
										<th>SNo</th>
										<th>Order Id</th>
										<th>Payment Status</th>
										<th>Booking Date</th>
										<th>Change Status</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Country</th>
										<th>State</th>
										<th>City</th>
										<th>Pin-Code</th>
										<th>Total Price</th>
										<th>Quantity</th>
										<th>Payment Id</th>
										<th>Payment Type</th>
									</tr>
								</thead>
								
								<tbody id="alldetails0">
									<?php
						    			// echo(count($data));
									$sn = 0;
						    		for ($i=0; $i < count($pending); $i++) { 
										if (!empty($pending)) {
											$sn = (int)$i+1;
						    				// print_r($data[$i]); 
									
						    		?>
							    			<tr>
												<td><?php echo $sn; ?></td>
												<td><?php echo $pending[$i]['order_id']; ?></td>
												<td>
													<?php 
													if ($pending[$i]['payment_status'] == 0) {
							                            $payment_status = '<span class="btn btn-warning">Pending</span>';
							                        }else if ($pending[$i]['payment_status'] == 1){
							                            $payment_status = '<span class="btn btn-primary">Complete</span>';
							                        }else if ($pending[$i]['payment_status'] == 2){
							                            $payment_status = '<span class="btn btn-warning">Dispatch</span>';
							                        }else if ($pending[$i]['payment_status'] == 4){
							                            $payment_status = '<span class="btn btn-warning">Rejected</span>';
							                        }else{
							                            $payment_status = '<span class="btn btn-warning">Cancel</span>';
							                        }
														echo $payment_status; 
													?>
													
												</td>
												<td><?php echo $pending[$i]['booking_date']; ?></td>
												<td>
													<select class="form-control" onchange="changeStatus(this.value,'<?php echo $pending[$i]["booking_id"]; ?>'); " >
														<option <?php if ($pending[$i]['payment_status'] == '0') { echo "selected"; } ?> value="0">Pending</option>
														<option <?php if ($pending[$i]['payment_status'] == '2') { echo "selected"; } ?> value="2">Dispatch</option>
														<option <?php if ($pending[$i]['payment_status'] == '1') { echo "selected"; } ?> value="1">Complete</option>
														<option <?php if ($pending[$i]['payment_status'] == '3') { echo "selected"; } ?> value="3">Cancel</option>
														<option <?php if ($pending[$i]['payment_status'] == '4') { echo "selected"; } ?> value="4">Return</option>
													</select>
												</td>
												<td><?php echo $pending[$i]['name']; ?></td>
												<td><?php echo $pending[$i]['email']; ?></td>
												<td><?php echo $pending[$i]['mobile']; ?></td>
												<td><?php echo $pending[$i]['address']; ?></td>
												<td><?php echo $pending[$i]['country']; ?></td>
												<td><?php echo $pending[$i]['state']; ?></td>
												<td><?php echo $pending[$i]['city']; ?></td>
												<td><?php echo $pending[$i]['pincode']; ?></td>
												<td><?php echo $pending[$i]['total_price']; ?></td>
												<td><?php echo $pending[$i]['quantity']; ?></td>
												<td><?php echo $pending[$i]['payment_id']; ?></td>
												<td><?php echo $pending[$i]['payment_type']; ?></td>
												
											</tr>
					    			<?php 
					    				}
						    		}
					    			?>
								</tbody>
						  </table>
	                     </div>
                  	</div>
                  	<div class="tab-pane fade" id="dispatch_past">
                      	<div class="row">
				            <div class="col-md-12">
				                
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="start_date2">
				                </div>
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="end_date2">
				                </div>
				                <div class="col-md-2">
				                    <button type="button" class="btn btn-primary" onclick="filterDispatchPastBookingData();">Submit</button>
				                </div>
				            </div>
				        </div>
	                    <div class="table-responsive">
	                     	<table class="table table-striped table-bordered table-hover tableExport">
								<thead>
									<tr>
										<th>SNo</th>
										<th>Order Id</th>
										<th>Payment Status</th>
										<th>Booking Date</th>
										<th>Change Status</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Country</th>
										<th>State</th>
										<th>City</th>
										<th>Pin-Code</th>
										<th>Total Price</th>
										<th>Quantity</th>
										<th>Payment Id</th>
										<th>Payment Type</th>
									</tr>
								</thead>
								
								<tbody id="alldetails2">
									<?php
						    			// echo(count($data));
									$sn = 0;
						    		for ($i=0; $i < count($dispatch); $i++) { 
										if (!empty($dispatch)) {
											$sn = (int)$i+1;
						    				// print_r($data[$i]); 
									
						    		?>
							    			<tr>
												<td><?php echo $sn; ?></td>
												<td><?php echo $dispatch[$i]['order_id']; ?></td>
												<td>
													<?php 
													if ($dispatch[$i]['payment_status'] == 0) {
							                            $payment_status = '<span class="btn btn-warning">Pending</span>';
							                        }else if ($dispatch[$i]['payment_status'] == 1){
							                            $payment_status = '<span class="btn btn-primary">Complete</span>';
							                        }else if ($dispatch[$i]['payment_status'] == 2){
							                            $payment_status = '<span class="btn btn-warning">Dispatch</span>';
							                        }else if ($dispatch[$i]['payment_status'] == 4){
							                            $payment_status = '<span class="btn btn-warning">Rejected</span>';
							                        }else{
							                            $payment_status = '<span class="btn btn-warning">Cancel</span>';
							                        }
														echo $payment_status; 
													?>
													
												</td>
												<td><?php echo $dispatch[$i]['booking_date']; ?></td>
												<td>
													<select class="form-control" onchange="changeStatus(this.value,'<?php echo $dispatch[$i]["booking_id"]; ?>'); " >
														<option <?php if ($dispatch[$i]['payment_status'] == '0') { echo "selected"; } ?> value="0">Pending</option>
														<option <?php if ($dispatch[$i]['payment_status'] == '2') { echo "selected"; } ?> value="2">Dispatch</option>
														<option <?php if ($dispatch[$i]['payment_status'] == '1') { echo "selected"; } ?> value="1">Complete</option>
														<option <?php if ($dispatch[$i]['payment_status'] == '3') { echo "selected"; } ?> value="3">Cancel</option>
														<option <?php if ($dispatch[$i]['payment_status'] == '4') { echo "selected"; } ?> value="4">Return</option>
													</select>
												</td>
												<td><?php echo $dispatch[$i]['name']; ?></td>
												<td><?php echo $dispatch[$i]['email']; ?></td>
												<td><?php echo $dispatch[$i]['mobile']; ?></td>
												<td><?php echo $dispatch[$i]['address']; ?></td>
												<td><?php echo $dispatch[$i]['country']; ?></td>
												<td><?php echo $dispatch[$i]['state']; ?></td>
												<td><?php echo $dispatch[$i]['city']; ?></td>
												<td><?php echo $dispatch[$i]['pincode']; ?></td>
												<td><?php echo $dispatch[$i]['total_price']; ?></td>
												<td><?php echo $dispatch[$i]['quantity']; ?></td>
												<td><?php echo $dispatch[$i]['payment_id']; ?></td>
												<td><?php echo $dispatch[$i]['payment_type']; ?></td>
										</tr>
					    			<?php 
					    				}
						    		}
					    			?>
								</tbody>
						  	</table>
	                    </div>
                  	</div>
                 	<div class="tab-pane fade" id="complete_past">
                      	<div class="row">
				            <div class="col-md-12">
				                
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="start_date1">
				                </div>
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="end_date1">
				                </div>
				                <div class="col-md-2">
				                    <button type="button" class="btn btn-primary" onclick="filterCompletePastBookingData();">Submit</button>
				                </div>
				            </div>
				        </div>
                       <div class="table-responsive">
	                     	<table class="table table-striped table-bordered table-hover tableExport">
								<thead>
									<tr>
										<th>SNo</th>
										<th>Order Id</th>
										<th>Payment Status</th>
										<th>Booking Date</th>
										<th>Change Status</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Country</th>
										<th>State</th>
										<th>City</th>
										<th>Pin-Code</th>
										<th>Total Price</th>
										<th>Quantity</th>
										<th>Payment Id</th>
										<th>Payment Type</th>
									</tr>
								</thead>
								
								<tbody id="alldetails1">
									<?php
						    			// echo(count($data));
									$sno = 0;
					    			for ($i=0; $i < count($complete); $i++) { 
										if (!empty($complete)) {
						    				// print_r($data[$i]); 
						    				$sno = (int)$i+1;
									
						    		?>
						    			<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $complete[$i]['order_id']; ?></td>
											<td>
													<?php 
													if ($complete[$i]['payment_status'] == 0) {
							                            $payment_status = '<span class="btn btn-warning">Pending</span>';
							                        }else if ($complete[$i]['payment_status'] == 1){
							                            $payment_status = '<span class="btn btn-primary">Complete</span>';
							                        }else if ($complete[$i]['payment_status'] == 2){
							                            $payment_status = '<span class="btn btn-warning">Dispatch</span>';
							                        }else if ($complete[$i]['payment_status'] == 4){
							                            $payment_status = '<span class="btn btn-warning">Rejected</span>';
							                        }else{
							                            $payment_status = '<span class="btn btn-warning">Cancel</span>';
							                        }
														echo $payment_status; 
													?>
													
												</td>
											<td><?php echo $complete[$i]['booking_date']; ?></td>
											<td>
													<select class="form-control" onchange="changeStatus(this.value,'<?php echo $complete[$i]["booking_id"]; ?>'); " >
														<option <?php if ($complete[$i]['payment_status'] == '0') { echo "selected"; } ?> value="0">Pending</option>
														<option <?php if ($complete[$i]['payment_status'] == '2') { echo "selected"; } ?> value="2">Dispatch</option>
														<option <?php if ($complete[$i]['payment_status'] == '1') { echo "selected"; } ?> value="1">Complete</option>
														<option <?php if ($complete[$i]['payment_status'] == '3') { echo "selected"; } ?> value="3">Cancel</option>
														<option <?php if ($complete[$i]['payment_status'] == '4') { echo "selected"; } ?> value="4">Return</option>
													</select>
												</td>
											<td><?php echo $complete[$i]['name']; ?></td>
											<td><?php echo $complete[$i]['email']; ?></td>
											<td><?php echo $complete[$i]['mobile']; ?></td>
											<td><?php echo $complete[$i]['address']; ?></td>
											<td><?php echo $complete[$i]['country']; ?></td>
											<td><?php echo $complete[$i]['state']; ?></td>
											<td><?php echo $complete[$i]['city']; ?></td>
											<td><?php echo $complete[$i]['pincode']; ?></td>
											<td><?php echo $complete[$i]['total_price']; ?></td>
											<td><?php echo $complete[$i]['quantity']; ?></td>
											<td><?php echo $complete[$i]['payment_id']; ?></td>
											<td><?php echo $complete[$i]['payment_type']; ?></td>
										</tr>
					    			<?php 
					    				}
						    		}
					    			?>
								</tbody>
						  </table>
	                     </div>
                  	</div>
                  	<div class="tab-pane fade" id="cancel_past">
                  		<div class="row">
				            <div class="col-md-12">
				                
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="start_date3">
				                </div>
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="end_date3">
				                </div>
				                <div class="col-md-2">
				                    <button type="button" class="btn btn-primary" onclick="filterCancelPastBookingData();">Submit</button>
				                </div>
				            </div>
				        </div>
                       <div class="table-responsive">
	                     	<table class="table table-striped table-bordered table-hover tableExport">
								<thead>
									<tr>
										<th>SNo</th>
										<th>Order Id</th>
										<th>Payment Status</th>
										<th>Booking Date</th>
										<th>Change Status</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Country</th>
										<th>State</th>
										<th>City</th>
										<th>Pin-Code</th>
										<th>Total Price</th>
										<th>Quantity</th>
										<th>Payment Id</th>
										<th>Payment Type</th>
									</tr>
								</thead>
								
								<tbody id="alldetails3">
									<?php
						    			// echo(count($data));
									$sno = 0;
					    			for ($j=0; $j < count($cancel); $j++) { 
										if (!empty($cancel)) {
						    				// print_r($data[$i]); 
						    				$sno = (int)$j+1;
									
						    		?>
							    			<tr>
												<td><?php echo $sno; ?></td>
												<td><?php echo $cancel[$j]['order_id']; ?></td>
												<td>
													<?php 
													if ($cancel[$j]['payment_status'] == 0) {
							                            $payment_status = '<span class="btn btn-warning">Pending</span>';
							                        }else if ($cancel[$j]['payment_status'] == 1){
							                            $payment_status = '<span class="btn btn-primary">Complete</span>';
							                        }else if ($cancel[$j]['payment_status'] == 2){
							                            $payment_status = '<span class="btn btn-warning">Dispatch</span>';
							                        }else if ($cancel[$j]['payment_status'] == 4){
							                            $payment_status = '<span class="btn btn-warning">Rejected</span>';
							                        }else{
							                            $payment_status = '<span class="btn btn-warning">Cancel</span>';
							                        }
														echo $payment_status; 
													?>
													
												</td>
												<td><?php echo $cancel[$j]['booking_date']; ?></td>
												<td>
													<select class="form-control" onchange="changeStatus(this.value,'<?php echo $cancel[$j]["booking_id"]; ?>'); " >
														<option <?php if ($cancel[$j]['payment_status'] == '0') { echo "selected"; } ?> value="0">Pending</option>
														<option <?php if ($cancel[$j]['payment_status'] == '2') { echo "selected"; } ?> value="2">Dispatch</option>
														<option <?php if ($cancel[$j]['payment_status'] == '1') { echo "selected"; } ?> value="1">Complete</option>
														<option <?php if ($cancel[$j]['payment_status'] == '3') { echo "selected"; } ?> value="3">Cancel</option>
														<option <?php if ($cancel[$j]['payment_status'] == '4') { echo "selected"; } ?> value="4">Return</option>
													</select>
												</td>
												<td><?php echo $cancel[$j]['name']; ?></td>
												<td><?php echo $cancel[$j]['email']; ?></td>
												<td><?php echo $cancel[$j]['mobile']; ?></td>
												<td><?php echo $cancel[$j]['address']; ?></td>
												<td><?php echo $cancel[$j]['country']; ?></td>
												<td><?php echo $cancel[$j]['state']; ?></td>
												<td><?php echo $cancel[$j]['city']; ?></td>
												<td><?php echo $cancel[$j]['pincode']; ?></td>
												<td><?php echo $cancel[$j]['total_price']; ?></td>
												<td><?php echo $cancel[$j]['quantity']; ?></td>
												<td><?php echo $cancel[$j]['payment_id']; ?></td>
												<td><?php echo $cancel[$j]['payment_type']; ?></td>
											</tr>
					    			<?php 
					    				}
						    		}
					    			?>
								</tbody>
						  </table>
	                     </div>
                  	</div>
                  	<div class="tab-pane fade" id="return_past">
                      	<div class="row">
				            <div class="col-md-12">
				                
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="start_date4">
				                </div>
				                <div class="col-md-5">
				                    <input type="date" class="form-control" id="end_date4">
				                </div>
				                <div class="col-md-2">
				                    <button type="button" class="btn btn-primary" onclick="filterReturnPastBookingData();">Submit</button>
				                </div>
				            </div>
				        </div>
	                    <div class="table-responsive">
	                     	<table class="table table-striped table-bordered table-hover tableExport">
								<thead>
									<tr>
										<th>SNo</th>
										<th>Order Id</th>
										<th>Payment Status</th>
										<th>Booking Date</th>
										<th>Change Status</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Country</th>
										<th>State</th>
										<th>City</th>
										<th>Pin-Code</th>
										<th>Total Price</th>
										<th>Quantity</th>
										<th>Payment Id</th>
										<th>Payment Type</th>
									</tr>
								</thead>
								
								<tbody id="alldetails4">
									<?php
						    			// echo(count($data));
									$sn = 0;
						    		for ($i=0; $i < count($return); $i++) { 
										if (!empty($return)) {
											$sn = (int)$i+1;
						    				// print_r($data[$i]); 
									
						    		?>
							    			<tr>
												<td><?php echo $sn; ?></td>
												<td><?php echo $return[$i]['order_id']; ?></td>
												<td>
													<?php 
													if ($return[$i]['payment_status'] == 0) {
							                            $payment_status = '<span class="btn btn-warning">Pending</span>';
							                        }else if ($return[$i]['payment_status'] == 1){
							                            $payment_status = '<span class="btn btn-primary">Complete</span>';
							                        }else if ($return[$i]['payment_status'] == 2){
							                            $payment_status = '<span class="btn btn-warning">Dispatch</span>';
							                        }else if ($return[$i]['payment_status'] == 4){
							                            $payment_status = '<span class="btn btn-warning">Rejected</span>';
							                        }else{
							                            $payment_status = '<span class="btn btn-warning">Cancel</span>';
							                        }
														echo $payment_status; 
													?>
													
												</td>
												<td><?php echo $return[$i]['booking_date']; ?></td>
												<td>
													<select class="form-control" onchange="changeStatus(this.value,'<?php echo $return[$i]["booking_id"]; ?>'); " >
														<option <?php if ($return[$i]['payment_status'] == '0') { echo "selected"; } ?> value="0">Pending</option>
														<option <?php if ($return[$i]['payment_status'] == '2') { echo "selected"; } ?> value="2">Dispatch</option>
														<option <?php if ($return[$i]['payment_status'] == '1') { echo "selected"; } ?> value="1">Complete</option>
														<option <?php if ($return[$i]['payment_status'] == '3') { echo "selected"; } ?> value="3">Cancel</option>
														<option <?php if ($return[$i]['payment_status'] == '4') { echo "selected"; } ?> value="4">Return</option>
													</select>
												</td>
												<td><?php echo $return[$i]['name']; ?></td>
												<td><?php echo $return[$i]['email']; ?></td>
												<td><?php echo $return[$i]['mobile']; ?></td>
												<td><?php echo $return[$i]['address']; ?></td>
												<td><?php echo $return[$i]['country']; ?></td>
												<td><?php echo $return[$i]['state']; ?></td>
												<td><?php echo $return[$i]['city']; ?></td>
												<td><?php echo $return[$i]['pincode']; ?></td>
												<td><?php echo $return[$i]['total_price']; ?></td>
												<td><?php echo $return[$i]['quantity']; ?></td>
												<td><?php echo $return[$i]['payment_id']; ?></td>
												<td><?php echo $return[$i]['payment_type']; ?></td>
												
										</tr>
					    			<?php 
					    				}
						    		}
					    			?>
								</tbody>
						  	</table>
	                    </div>
                  	</div>
                </div>
        </div>
    </div>
    <!-- <img src="http://lorempixel.com/400/400/cats/3" alt="Cats"/> -->
           

<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    
    function filterPendingPastBookingData(){
        var start   	= document.getElementById('start_date0').value;
        var end     	= document.getElementById('end_date0').value;
        $.ajax({
            url: '<?php echo site_url("admin/Booking/filter_past_booking_history"); ?>',
            type: "POST",
            data: {
                "status"       	: 0,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails0').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var payment_status  = '';
                        
                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Complete</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            payment_status = '<span class="btn btn-warning">Return</span>';
                        }else{
                            payment_status = '<span class="btn btn-warning">Cancel</span>';
                        }

                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['order_id']+'</td><td>'+payment_status+'</td><td>'+obj[i]['booking_date']+'</td><td>'+obj[i]['change_status']+'</td><td>'+obj[i]['name']+'</td><td>'+obj[i]['email']+'</td><td>'+obj[i]['mobile']+'</td><td>'+obj[i]['address']+'</td><td>'+obj[i]['country']+'</td><td>'+obj[i]['state']+'</td><td>'+obj[i]['city']+'</td><td>'+obj[i]['pincode']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['quantity']+'</td><td>'+obj[i]['payment_id']+'</td><td>'+obj[i]['payment_type']+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails0').html(html);
                }
            }
        });
    }
    function filterCancelPastBookingData(){
        var start   	= document.getElementById('start_date3').value;
        var end     	= document.getElementById('end_date3').value;
        $.ajax({
            url: '<?php echo site_url("admin/Booking/filter_past_booking_history"); ?>',
            type: "POST",
            data: {
                "status"       	: 3,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails3').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var payment_status = '';
                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Complete</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            payment_status = '<span class="btn btn-warning">Return</span>';
                        }else{
                            payment_status = '<span class="btn btn-warning">Cancel</span>';
                        }

                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['order_id']+'</td><td>'+payment_status+'</td><td>'+obj[i]['booking_date']+'</td><td>'+obj[i]['change_status']+'</td><td>'+obj[i]['name']+'</td><td>'+obj[i]['email']+'</td><td>'+obj[i]['mobile']+'</td><td>'+obj[i]['address']+'</td><td>'+obj[i]['country']+'</td><td>'+obj[i]['state']+'</td><td>'+obj[i]['city']+'</td><td>'+obj[i]['pincode']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['quantity']+'</td><td>'+obj[i]['payment_id']+'</td><td>'+obj[i]['payment_type']+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails3').html(html);
                }
            }
        });
    }

    function filterCompletePastBookingData(){
        var start   = document.getElementById('start_date1').value;
        var end     = document.getElementById('end_date1').value;
        $.ajax({
            url: '<?php echo site_url("admin/Booking/filter_past_booking_history"); ?>',
            type: "POST",
            data: {
            	"status"       : 1,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails1').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var payment_status  = '';
                        
                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Complete</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            payment_status = '<span class="btn btn-warning">Return</span>';
                        }else{
                            payment_status = '<span class="btn btn-warning">Cancel</span>';
                        }
                        
                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['order_id']+'</td><td>'+payment_status+'</td><td>'+obj[i]['booking_date']+'</td><td>'+obj[i]['change_status']+'</td><td>'+obj[i]['name']+'</td><td>'+obj[i]['email']+'</td><td>'+obj[i]['mobile']+'</td><td>'+obj[i]['address']+'</td><td>'+obj[i]['country']+'</td><td>'+obj[i]['state']+'</td><td>'+obj[i]['city']+'</td><td>'+obj[i]['pincode']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['quantity']+'</td><td>'+obj[i]['payment_id']+'</td><td>'+obj[i]['payment_type']+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails1').html(html);
                }
            }
        });
    }

    function filterReturnPastBookingData(){
        var start   = document.getElementById('start_date4').value;
        var end     = document.getElementById('end_date4').value;
        $.ajax({
            url: '<?php echo site_url("admin/Booking/filter_past_booking_history"); ?>',
            type: "POST",
            data: {
                "status"        : 4,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails4').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var payment_status  = '';
                        
                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Complete</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            payment_status = '<span class="btn btn-warning">Return</span>';
                        }else{
                            payment_status = '<span class="btn btn-warning">Cancel</span>';
                        }
                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['order_id']+'</td><td>'+payment_status+'</td><td>'+obj[i]['booking_date']+'</td><td>'+obj[i]['change_status']+'</td><td>'+obj[i]['name']+'</td><td>'+obj[i]['email']+'</td><td>'+obj[i]['mobile']+'</td><td>'+obj[i]['address']+'</td><td>'+obj[i]['country']+'</td><td>'+obj[i]['state']+'</td><td>'+obj[i]['city']+'</td><td>'+obj[i]['pincode']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['quantity']+'</td><td>'+obj[i]['payment_id']+'</td><td>'+obj[i]['payment_type']+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails4').html(html);
                }
            }
        });
    }
    function filterDispatchPastBookingData(){
        var start   = document.getElementById('start_date2').value;
        var end     = document.getElementById('end_date2').value;
        $.ajax({
            url: '<?php echo site_url("admin/Booking/filter_past_booking_history"); ?>',
            type: "POST",
            data: {
                "status"        : 2,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails2').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var payment_status  = '';


                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Complete</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            payment_status = '<span class="btn btn-warning">Return</span>';
                        }else{
                            payment_status = '<span class="btn btn-warning">Cancel</span>';
                        }
                        // obj[i]['payment_status']
                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['order_id']+'</td><td>'+payment_status+'</td><td>'+obj[i]['booking_date']+'</td><td>'+obj[i]['change_status']+'</td><td>'+obj[i]['name']+'</td><td>'+obj[i]['email']+'</td><td>'+obj[i]['mobile']+'</td><td>'+obj[i]['address']+'</td><td>'+obj[i]['country']+'</td><td>'+obj[i]['state']+'</td><td>'+obj[i]['city']+'</td><td>'+obj[i]['pincode']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['quantity']+'</td><td>'+obj[i]['payment_id']+'</td><td>'+obj[i]['payment_type']+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails2').html(html);
                }
            }
        });
    }

    function changeStatus(status,booking_id)
    {
    	if (confirm('Are you sure you want to change status?')) {
            $.ajax({
                url: '<?php echo site_url("admin/Booking/changeStatus"); ?>',
                type: "POST",
                data: {
                    "payment_status": status,
                    "booking_id" 	: booking_id,
                },
                success: function (response) {
                    location.reload();
                }
            });
        }
    }
</script>