<div id="page-wrapper">
	<div class="header"> 
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Delivery Man</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/Delivery_man/add_delivery_man');?>">Add Delivery Man</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Delivery Man
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Driver Identification Id</th>
                                        <th>First Name</th>
                                        <th>last Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Driver Vehicle Number</th>
                                        <th>Profile</th>
                                        <th>Kyc Verified Status</th>
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
                                                <td><?php echo $key['driver_identification_id']; ?></td>
                                                <td><?php echo $key['delivery_man_first_name']; ?></td>
                                                <td><?php echo $key['delivery_man_last_name']; ?></td>
                                                <td><?php echo $key['delivery_man_email']; ?></td>
                                                <td><?php echo $key['delivery_man_pwd']; ?></td>
                                                <td><?php echo $key['delivery_man_contact']; ?></td>
                                                <td><?php echo $key['delivery_man_address']; ?></td>
                                                <td><?php echo $key['driver_vehicle_number']; ?></td>
                                                <?php
                                                    if (!empty($key['delivery_man_profile'])) { ?>
                                                        <td><img src="<?php echo base_url().'delivery_man/'.$key['delivery_man_profile']; ?>" height="30px" width="30px"></td>
                                                        
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <?php
                                                    if ($key['kyc_verified_status'] == 3) {
                                                        $kyc = '<span class = "btn btn-warning" >Pending</span>';
                                                    }else if ($key['kyc_verified_status'] == 1){
                                                        $kyc = '<span class = "btn btn-primary" >Approved</span>';
                                                    }else if ($key['kyc_verified_status'] == 2){
                                                        $kyc = '<span class = "btn btn-danger" >Rejected</span>';
                                                    }else{
                                                        $kyc = '';
                                                    }
                                                ?>
                                                <td><?php echo $kyc; ?></td>
                                                <td class="center">
                                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('admin/Delivery_man/edit_delivery_man/'.$key["delivery_man_id"]);?>">Edit</a>
                                                    <a class="btn btn-danger btn-sm" onclick="delteFunction('<?php echo $key["delivery_man_id"] ;?>')">Delete</a>
                                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('admin/Delivery_man/kyc/'.$key["delivery_man_id"]);?>">Kyc</a>
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
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("admin/Delivery_man/delete_delivery_man"); ?>',
                type: "POST",
                data: {
                    "delivery_man_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Delivery Man!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Delivery Man!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>