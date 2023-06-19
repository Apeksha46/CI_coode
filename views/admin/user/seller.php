<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Seller<small>Xiri</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Seller</li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Seller
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>First Name</th>
                                        <th>last Name</th>
                                        <th>Business Name</th>
                                        <th>Business Address</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($tableData as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['seller_first_name']; ?></td>
                                                <td><?php echo $key['seller_last_name']; ?></td>
                                                <td><?php echo $key['seller_business_name']; ?></td>
                                                <td><?php echo $key['seller_business_address']; ?></td>
                                                <td><?php echo $key['seller_email']; ?></td>
                                                <td><?php echo $key['seller_mobile']; ?></td>
                                                <td class="center">
                                                    <?php
                                                        if ($key["active_status"] == 0) { ?>
                                                            <a class="btn btn-danger" onclick="acceptFunction('<?php echo $key["seller_id"] ;?>')">Accept</a>
                                                        <?php }else{ ?>
                                                            <a class="btn btn-primary" onclick="rejectFunction('<?php echo $key["seller_id"] ;?>')">Reject</a>
                                                        <?php }
                                                    ?>

                                                </td>
                                            </tr>
                                       <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    function acceptFunction(val){
        if (confirm('Are you sure you want to Accept ?')) {
            $.ajax({
                url: '<?php echo site_url("admin/User/accept_seller"); ?>',
                type: "POST",
                data: {
                    "seller_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>seller!</strong> Accepted.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>seller!</strong> Not Accepted.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
    function rejectFunction(val){
        if (confirm('Are you sure you want to Reject ?')) {
            $.ajax({
                url: '<?php echo site_url("admin/User/reject_seller"); ?>',
                type: "POST",
                data: {
                    "seller_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Seller!</strong> Rejected.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Seller!</strong> Not Rejected.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>