<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            User<small>Small Bazar</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">User</li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
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
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Referal Code</th>
                                        <th>Wallet Balance</th>
                                        <th>Contact</th>
                                        <th>Package</th>
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
                                                <td><?php echo $key['first_name']; ?></td>
                                                <td><?php echo $key['last_name']; ?></td>
                                                <td><?php echo $key['email']; ?></td>
                                                <td><?php echo $key['pwd']; ?></td>
                                                <td><?php echo $key['referal_code']; ?></td>
                                                <td><?php echo $key['wallet']; ?></td>
                                                <td><?php echo $key['mobile']; ?></td>
                                                <?php
                                                    if ($key['package_id'] == 0) {
                                                        echo "<td><span class = 'btn btn-danger'>Un-Paid</span></td>";
                                                    }else{
                                                        echo "<td><span class = 'btn btn-primary'>Paid</span></td>";
                                                    }
                                                ?>
                                                <?php
                                                    // if ($key['package_id'] == 0) { 
                                                        ?>

                                                        <td class="center">
                                                            <select class="form-control" onchange = "paidFunction('<?php echo $key["user_id"] ;?>',this.value)">
                                                                <option value = '0'> Select Package </option>
                                                                <?php
                                                                    if (!empty($package)) {
                                                                        foreach ($package as $keyy => $value) {

                                                                ?>
                                                                            <option <?php if(!empty($key['package_id'])){ if($key['package_id'] == $value['package_id']){ echo "selected"; } } ?> value="<?php echo $value['package_id'];?>"><?php echo $value['package_name'];?></option>
                                                                <?php   } 
                                                                    }else{
                                                                        echo "<option value = '0'> No package Available </option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <a class="btn btn-primary" href="<?php echo site_url('admin/User/refer_list/'.$key["user_id"]);?>">Refer List</a>

                                                        </td>
                                                <?php 
                                            // }else{ echo '<td></td>'; } 
                                            ?>
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
        $('#dataTables-example').dataTable({
            // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [10, 20, 40, 60, 80, 100,200,300 ], 
        });
    });
    function paidFunction(val,package_id){
        if (confirm('Are you sure you want to Assign Package this?')) {
            $.ajax({
                url: '<?php echo site_url("admin/User/paid"); ?>',
                type: "POST",
                data: {
                    "user_id"       : val,
                    "package_id"    : package_id
                },
                success: function (response) {
                    console.log(response);
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Package!</strong> add successful.</div>');
                        }, 3000);
                        location.reload();
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Package!</strong> Not added.</div>'); 
                        }, 3000);   
                    }
                    
                }
            });
        }
    }
</script>