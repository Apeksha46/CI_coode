<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" />
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        color: #fff !important;
    }
</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
		  	<li><a href="<?php echo site_url('admin/User/seller');?>">Seller</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Sale History</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-3">
                <input type="date" class="form-control" id="start_date">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="end_date">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" onclick="filterData();">Submit</button>
            </div><div class="col-md-3">
                <!-- <button type="button" class="btn btn-primary">Export</button> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sale History
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tableExport">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Actual Product Price</th>
                                        <th>Bargaining Product ?</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Booking Date</th>
                                        <th>Booking Type</th>
                                        <th>Booking Status</th>
                                    </tr>
                                </thead>
                                <tbody id="alldetails">
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($sale as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['customer_first_name'].' '.$key['customer_last_name']; ?></td>
                                                <td><?php echo $key['product_name']; ?></td>
                                                <td><?php echo $key['actual_price']; ?></td>
                                                <?php
                                                    if (empty($key['bargaining_price'])) {
                                                        $bargain_status = '<span class="btn btn-danger">No</span>';
                                                    }else{
                                                        $bargain_status = '<span class="btn btn-primary">Yes</span>';
                                                    }
                                                ?>
                                                
                                                <td><?php echo $bargain_status; ?></td>
                                                <td><?php echo $key['purchase_qty']; ?></td>
                                                <td><?php echo $key['total_price']; ?></td>
                                                <td><?php echo $key['booking_date']; ?></td>
                                                <?php
                                                    if ($key['payment_mode'] == 0) {
                                                        $payment_mode = '<span class="btn btn-warning">COD</span>';
                                                    }else if (empty($key['payment_mode'] == 1)){
                                                        $payment_mode = '<span class="btn btn-primary">Net Banking</span>';
                                                    }else{
                                                        $payment_mode = '<span class="btn btn-warning">Credit/Debit/Atm card</span>';
                                                    }
                                                ?>
                                                <td><?php echo $payment_mode; ?></td>
                                                <!-- 0=pending,1=driver accept booking,2=order dispatch,3=delivered(complete) -->
                                                <?php
                                                    if ($key['payment_status'] == 0) {
                                                        $payment_status = '<span class="btn btn-warning">Pending</span>';
                                                    }else if ($key['payment_status'] == 1){
                                                        $payment_status = '<span class="btn btn-primary">Accept Booking By Driver</span>';
                                                    }else if ($key['payment_status'] == 2){
                                                        $payment_status = '<span class="btn btn-warning">Dispatch</span>';
                                                    }else if ($key['payment_status'] == 4){
                                                        $payment_status = '<span class="btn btn-warning">Rejected</span>('.$key['reject_booking_message'].')';
                                                    }else{
                                                        $payment_status = '<span class="btn btn-default">Complete</span>';
                                                    }
                                                ?>
                                                <td><?php echo $payment_status; ?></td>
                                                
                                            </tr>
                                       <?php $i++; } ?>
                                </tbody>
                                <tbody id="klj">

                                </tbody>
                            </table>
                        </div>
                        <!-- <a href="<?php echo site_url('admin/User/customer');?>" style="text-decoration: none;">
                            <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                                <i class="fa fa-angle-left" aria-hidden="true" style="color: #FFF;"></i>
                                Back                
                            </div>
                        </a> -->
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<script type="text/javascript">

    function filterData(){
        var start   = document.getElementById('start_date').value;
        var end     = document.getElementById('end_date').value;
        var seller_id = '<?php echo $this->uri->segment(4); ?>';
        $.ajax({
            url: '<?php echo site_url("admin/User/filter_sale_history"); ?>',
            type: "POST",
            data: {
                "seller_id"     : seller_id,
                "start"         : start,
                "end"           : end
            },
            success: function (response) {
                if (response == '0') {
                    // $('#alldetails').html('<tr>No result</tr>');
                    $('#alldetails').html('<tr></tr>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    $('#klj').html("");
                    for(var i=0; i<obj.length; i++){
                        j++;
                        var bargain_status  = '';
                        var payment_mode    = '';
                        var payment_status  = '';
                        var seller_name     = obj[i]['customer_first_name']+' '+obj[i]['customer_last_name'];

                        if (obj[i]['bargaining_price']) {
                            bargain_status = '<span class="btn btn-danger">No</span>';
                        }else{
                            bargain_status = '<span class="btn btn-primary">Yes</span>';
                        }

                        if (obj[i]['payment_mode'] == 0) {
                            payment_mode = '<span class="btn btn-warning">COD</span>';
                        }else if (obj[i]['payment_mode'] == 1){
                            payment_mode = '<span class="btn btn-primary">Net Banking</span>';
                        }else{
                            payment_mode = '<span class="btn btn-warning">Credit/Debit/Atm card</span>';
                        }

                        if (obj[i]['payment_status'] == 0) {
                            payment_status = '<span class="btn btn-warning">Pending</span>';
                        }else if (obj[i]['payment_status'] == 1){
                            payment_status = '<span class="btn btn-primary">Accept Booking By Driver</span>';
                        }else if (obj[i]['payment_status'] == 2){
                            payment_status = '<span class="btn btn-warning">Dispatch</span>';
                        }else if (obj[i]['payment_status'] == 4){
                            $payment_status = '<span class="btn btn-warning">Rejected</span>('+obj[i]['reject_booking_message']+')';
                        }else{
                            payment_status = '<span class="btn btn-default">Complete</span>';
                        }
                        
                        var url = '<?php echo site_url().'/seller/User/export/' ?>';
                        
                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+seller_name+'</td><td>'+obj[i]['product_name']+'</td><td>'+obj[i]['actual_price']+'</td><td>'+bargain_status+'</td><td>'+obj[i]['purchase_qty']+'</td><td>'+obj[i]['total_price']+'</td><td>'+obj[i]['booking_date']+'</td><td>'+payment_mode+'</td><td>'+payment_status+'</td></tr>';
                    }
                        // console.log(html)
                    // $("#alldetails").val("");
                    // $("#alldetails").css("display",'none');
                    $('#alldetails').html(html);
                }
            }
        });
    }
</script>

    
