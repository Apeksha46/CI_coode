<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Gold Package User<small>Small Bazar</small>
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
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-info alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php } if($this->session->flashdata('error')){  ?>
                         <div class="alert alert-danger alert-dismissible" id="hideDivId">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                        </div>
                    <?php } ?>
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
                                                <td class="center">
                                                    <a class="btn btn-danger" onclick="addPercentAmountInWallet('<?php echo $key['user_id']; ?>');">Add % to User Wallet</a>    
                                                     <a class="btn btn-primary" href="<?php echo site_url('admin/User/refer_list/'.$key["user_id"]);?>">Refer List</a>
                                                </td>
                                            </tr>
                                       <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add some % amount in wallet</h4>
                                    </div>
                                    <div class="modal-body">
                                        <select class="form-control" id="type">
                                            <option value="amount">Amount</option>
                                            <option value="percentage">Percentage</option>
                                        </select><br/>
                                        <select class="form-control" id="method">
                                            <option value="add">Add</option>
                                            <option value="sub">Subtract</option>
                                        </select><br/>
                                        <input type="hidden" id="user_id" name="user_id">
                                        <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="per_amt" name="per_amt">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" onclick="addAmount();">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
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
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Package!</strong> add successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Package!</strong> Not added.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
    function addPercentAmountInWallet(id)
    {
        $('#user_id').val(id);
        $('#myModal').modal('show');
    }

    function addAmount()
    {
        $.ajax({
            url: '<?php echo site_url("admin/Package/addAmount"); ?>',
            type: "POST",
            data: {
                "method"     : $('#method').val(),
                "type"       : $('#type').val(),
                "user_id"    : $('#user_id').val(),
                "per_amt"    : $('#per_amt').val()
            },
            success: function (response) {
                
                location.reload();
            }
        });
    }
</script>